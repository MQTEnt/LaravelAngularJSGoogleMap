//Google Map 
var map;
var myCenter=new google.maps.LatLng(21.023943953402217,105.84157705307007); //Điểm trung tâm bản đồ
var myMarker; //Điểm sau khi click
var placeLat; 
var placeLon;
var placeDescription;
var placeName;
var infowindow; //Thông tin điểm 
function initMap(dataPlaces)
{
	var mapProp = {
		center:myCenter,
		zoom:15,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	console.log(dataPlaces);
	//sửa lại hàm $.each này sang một hàm JavaScript thuần cho đồng bộ
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

//Get list place từ server
$(document).ready(function(){
	$.get('/place/getList',function(dataPlaces){
		//console.log(dataPlaces);
		/*
		*	Cần phải đưa hàm load map (google.maps.event.addDomListener) vào trong callback function này
		*	để tránh việc không hiển thị marker trên bản đồ (mặc dù một số trường hợp load được vì đường truyền mạng)
		*	hoặc sử dụng các loại trình duyệt khác nhau
		*/
		google.maps.event.addDomListener(window, 'load', initMap(dataPlaces));
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