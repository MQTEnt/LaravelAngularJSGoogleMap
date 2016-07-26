<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home page</title>
	<link rel="stylesheet" href="/css/mystyle.css">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBJZuC9pIER2R-A1bHmIU9swuSfGclEHSk"></script>
</head>
<body>
	<div class="container">
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="row" ng-app="gmApp" ng-controller="gmCtrl">
			<div class="col-sm-6 col-sm-offset-3">
				<div id="googleMap" style="width: auto; height: 500px; border: solid 1px; border-color: white;"></div>
			</div>
		</div>
		<!-- Button reset marker
		<div class="row" style="margin-top: 20px;">
			<div class="col-sm-6 col-sm-offset-3">
				<button id="btnResetMarker" type="button" class="btn btn-success">Reset mark</button>
			</div>
		</div>
		-->
		<div class="row" style="margin-top: 20px;">
			<div class="col-sm-6 col-sm-offset-3">
				<button id="btnAddInfo" type="button" class="btn btn-info">Add info</button>
			</div>
		</div>
		<div id="pnInfo" class="row" style="margin-top: 20px;">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-info">
					<div class="panel-heading">Infomartion of marker</div>
					<div class="panel-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label">Name:</label>
								<div class="col-sm-9">
									<input id="txtName" type="text" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Description:</label>
								<div class="col-sm-9">
									<textarea id="txtDescription" rows="10" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div id="btnSubmit" type="button" class="btn btn-success pull-right">Submit</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script>
	//Google Map 
	var map;
	var myCenter=new google.maps.LatLng(21.023943953402217,105.84157705307007); //Điểm trung tâm bản đồ
	var myMarker; //Điểm sau khi click
	var placeLat; 
	var placeLon;
	var placeDescription;
	var placeName;
	var infowindow; //Thông tin điểm 
	function initMap()
	{
		var mapProp = {
			center:myCenter,
			zoom:15,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(event.latLng);
		});
	}
	function placeMarker(location) 
	{
		//Mỗi lần click thì xóa marker cũ: setMap(null) sau đó gán giá trị mới cho marker
		if(typeof myMarker !='undefined') //Vì lần đầu tiên myMarker undifined nên không dùng được setMap()
		{
			myMarker.setMap(null);
		}
		myMarker = new google.maps.Marker({
			position: location,
			map: map
		});
		placeLat=location.lat();
		placeLon=location.lng();
		//Khai báo và hiển thị thông tin marker
		infowindow = new google.maps.InfoWindow({
			content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
		});
		infowindow.open(map,myMarker);
	}
	//Load bản đồ sau khi đã khai báo các thành phần
	google.maps.event.addDomListener(window, 'load', initMap);

	//Get list place từ server
	$(document).ready(function(){
		$.get('/place/getList',function(dataPlaces){
			//console.log(dataPlaces);
			$.each(dataPlaces, function(key, value){
				//Tạo marker
				var markers = new google.maps.Marker({
					position: {lat: parseFloat(value.lat), lng: parseFloat(value.lon)},
					map: map
				});
				//Tạo sự kiện click cho marker
				markers.addListener('click',function(){
					infowindows = new google.maps.InfoWindow({
						content: value.name
					});
					infowindows.open(map,markers);
				});
			});
		});
	});

	$(document).ready(function(){
		//Ẩn panel Info lúc đầu
		$('#pnInfo').hide();
		
		// Reset marker
		// $('#btnResetMarker').click(function(){
		// 	myMarker.setMap(null);
		// });
		
		$('#btnAddInfo').click(function(){
			$('#pnInfo').toggle(300);
		});

		$('#btnSubmit').click(function(){
			if(typeof placeLat == 'undefined')
				alert('Please choose a place on map');
			else
			{
				placeDescription=$('#txtDescription').val();
				placeName=$('#txtName').val();
				token=$("input[type='hidden']").val();
				dataSendToServer={
					'name': placeName,
					'lat': placeLat,
					'lon': placeLon,
					'description': placeDescription,
					'_token': token
				};
				//console.log(dataSendToServer);
				$.post('/place/store',dataSendToServer,function(dataResponse){
					if(dataResponse==1)
					{
						alert('Add Success');
						//Ẩn panel và reset các input sau khi đã thêm 
						$('#pnInfo').toggle(300);
						$('#txtName').val("");
						$('#txtDescription').val("");

						//Hiển thị điểm mới thêm lên bản đồ
						var marker = new google.maps.Marker({
							position: {lat: parseFloat(placeLat), lng: parseFloat(placeLon)},
							map: map
						});
						//Ẩn infowindow cũ
						infowindow.close();
						//Tạo infowindow mới
						var infowindowNew;
						infowindowNew = new google.maps.InfoWindow({
								content: placeName
						});
						//Tạo sự kiện click cho marker
						marker.addListener('click',function(){
							infowindowNew.open(map,marker);
						});
						//Mở infowindow mới
						infowindowNew.open(map,marker);
					}
					else
						alert('Error');
				});
			}
		});
	});
</script>
</body>
</html>