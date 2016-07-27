<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>List</title>
	<link rel="stylesheet" href="/css/mystyle.css">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBJZuC9pIER2R-A1bHmIU9swuSfGclEHSk"></script>
</head>
<body>
	<div class="container">
		<div class="row" ng-app="googlemapApp" ng-controller="googlemapCtrl">
			<div class="col-md-6">
				<div id="googleMap" style="width: auto; height: 430px; border: solid 1px; border-color: white; margin-bottom:20px;"></div>
			</div>
			<div class="col-md-6">
				<!-- form -->
				<div class="row">
					<!--Information-->
					<div class="col-md-12">
						<button id="btnInfo" class="btn btn-info col-md-2">Info</button>
					</div>
					<div class="col-md-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								Information
							</div>
							<div class="panel-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label class="control-label col-sm-2">Name:</label>
										<div class="col-sm-10">
											<input name="txtName" type="text" class="form-control" ng-model="selectedPlace.name">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Description:</label>
										<div class="col-sm-10">
											<textarea class="form-control" name="txtDescription" cols="30" rows="5" ng-model="selectedPlace.description"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Votes:</label>
										<div class="col-sm-10">
											<button type="button" id="btnVote" class="btn btn-default glyphicon glyphicon-thumbs-up" ng-model="selectedPlace.votes" data-loading-text=" ... " ng-click="votes(this)">{{selectedPlace.votes}}</button>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-8">
											<div class="col-sm-6">
												<button class="btn btn-success pull-right" ng-click="editLngLat()"><span class="glyphicon glyphicon-map-marker"></span></button>
											</div>
											<div class="col-sm-6">
												<button id="btnUpdate" class="btn btn-success pull-right" ng-click="updatePlace(selectedPlace.id)">Update</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--Reviews -->
					<div class="col-md-12">
						<button id="btnReview" class="btn btn-warning col-md-2">Reivews</button>
					</div>
					<div class="col-md-12">
						<div class="panel panel-warning">
							<div class="panel-heading">
								Reviews of {{selectedPlace.name}}
							</div>
							<div class="panel-body">
								<form class="form-horizontal">
									<div class="list-group">
										<a href="#" class="list-group-item">Bài review 1<span class="badge">1</span></a>
										<a href="#" class="list-group-item">Bài review 2<span class="badge">2</span></a>
										<a href="#" class="list-group-item">Bài review 3<span class="badge">3</span></a>
										<a href="#" class="list-group-item">Bài review 4<span class="badge">4</span></a>
										<a href="#" class="list-group-item">Bài review 5<span class="badge">5</span></a>
									</div>
									<div class="row">
										<div class="col-sm-1 col-sm-offset-10">
											<button id="btnMore" type="button" class="btn btn-success glyphicon glyphicon-th-list pull-right"></button>
										</div>
										<div class="col-sm-1">
											<button id="btnAddReview" type="button" class="btn btn-success glyphicon glyphicon-pencil pull-right" data-toggle="modal" data-target="#myModal"></button>
											<!-- Modal -->
											<div class="modal fade" id="myModal" role="dialog">
												<div class="modal-dialog modal-lg">
													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">New review</h4>
														</div>
														<div class="modal-body">
															<div class="formNewReview">
																<div class="form-group">
																	<label class="col-sm-3 col-sm-offset-1">Title:</label>
																	<div class="col-sm-10 col-sm-offset-1">
																		<input type="text" class="form-control" placeholder="Fill the title">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 col-sm-offset-1">Content:</label>
																	<div class="col-sm-10 col-sm-offset-1">
																		<textarea name="" id="" class="form-control" row="5"></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 col-sm-offset-1">Tag:</label>
																	<div class="col-sm-10 col-sm-offset-1">
																		<input type="text" class="form-control" placeholder="Eg: Park, Zoo, Beautiful...">
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-11">
																		<button class="btn btn-success pull-right" type="button">Submit</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- End Modal -->
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--End reivew-->
				</div>
			</div>
		</div>
	</div>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/angular.min.js"></script>
	<script>
	//jQuery chỉ sử lý phần hiển thị panel khi click button
	$(document).ready(function(){
		$('.panel-info').hide();
		$('.panel-warning').hide();

		$('#btnInfo').click(function(){
			$('.panel-warning').hide(300);
			$('.panel-info').toggle(300);
		});

		$('#btnReview').click(function(){
			$('.panel-info').hide(300);
			$('.panel-warning').toggle(300);
		});

		//Vote
		// $('#btnVote').click(function (){
		// 	votes=$(this).text();
		// 	votes++;
		//     $(this).text(' '+votes)
		//     $(this).attr('disabled','disabled');
		//  });

	});

	//Google Map 
	var map;
	var myCenter=new google.maps.LatLng(21.023943953402217,105.84157705307007); //Điểm trung tâm bản đồ
	var markers=[]; //Các điểm trên map
	var newMarker;	//Điểm mới (dành cho chức năng sửa điểm mới)
	var modeEdit=false;
	function initMap()
	{
		//Thông tin map
		var mapProp = {
			center:myCenter,
			zoom:15,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

		//Setting click map event
		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(event.latLng);
		});
	};
	//Load map
	google.maps.event.addDomListener(window, 'load', initMap);

	//Click map event
	function placeMarker(location) 
	{
		if(modeEdit==true) //Nếu là chế độ sửa marker...
		{
			//Mỗi lần click thì xóa marker cũ: setMap(null) sau đó gán giá trị mới cho marker
			if(typeof newMarker !='undefined') //Vì lần đầu tiên newMarker undifined nên không dùng được setMap()
			{
				newMarker.setMap(null);
			}
			newMarker = new google.maps.Marker({
				position: location,
				map: map
			});
			//Khai báo và hiển thị thông tin marker
			var infoWindow = new google.maps.InfoWindow({
				content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng() +'<br> Click <b>Update</b> if you want to choose this place'
			});
			infoWindow.open(map,newMarker);
			//console.log(newMarker);
		}
	}

	//AngularJS
	var gmApp=angular.module('googlemapApp',[]);
	gmApp.controller('googlemapCtrl',function($scope, $http){
		$scope.selectedPlace='unknow';
		//Khai báo hàm getList() (lấy danh sách marker và hiển thị) 
		$scope.getList=function(){
			$http.get('/place/getList').success(function(dataPlaces)
			{
				angular.forEach(dataPlaces,function(value, key)
				{
					//Tạo marker
					var marker = new google.maps.Marker({
						position: {lat: parseFloat(value.lat), lng: parseFloat(value.lon)},
						map: map
					});
					markers.push(marker);
					//Gán giá trị cho marker vừa tạo
					var markerProp = new Object(); //Tạo object mới chứa thông tin của marker
					markerProp.id=value.id;
					markerProp.name=value.name;
					markerProp.description=value.description;
					markerProp.lat=value.lat;
					markerProp.lon=value.lon;
					markerProp.votes=value.votes;

					//Khai báo infowindow cho marker
					var infowindow = new google.maps.InfoWindow({
							content: value.name
					});
					//Click marer event
					marker.addListener('click',function(){
						$scope.selectedPlace=markerProp;
						//Chú ý sử dụng $apply() để đồng bộ với controller
						$scope.$apply();
						//Hiển thị infowindow cho marker
						infowindow.open(map,marker);
					});
				});	
			});
		};
		//Gọi hàm getList();
		$scope.getList();

		//Update...
		$scope.updatePlace=function(id){
			var data; //Dữ liệu gửi tới server
			if(modeEdit==true)
			{
				//Thay đổi giá trị tọa độ (nếu có) để gửi tới server
				$scope.selectedPlace.lat=newMarker.position.lat();
				$scope.selectedPlace.lon=newMarker.position.lng();
				//console.log(data);
			}
			data=$.param($scope.selectedPlace); //Gán dữ liệu

			console.log(data);
			$http({
				method: 'POST',
				url: '/place/'+id+'/update',
				data: data,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
				//console.log(response);
				if(modeEdit==true) //Nếu có thay đổi tọa độ thì tải lại các marker
				{
					modeEdit=false;//Đồng thời tắt chế độ edit
					$scope.getList();
					//Xóa điểm vừa edit khỏi bản đồ để không lưu lại cho những lần sửa sau
					newMarker.setMap(null);
				}
				alert('Update Success');
			}).error(function(response){
				//console.log(response);
				alert('Error');
			});
		};

		//Vote Button
		$scope.votes=function(){
			//Dùng Ajax để kiểm tra user đã vote địa điểm này hay chưa, sau đó xử lý
			alert('vote place');
		};
		$scope.editLngLat=function(){
			if(typeof $scope.selectedPlace.name != 'undefined')
			{
				modeEdit=true; //Enable mode edit marker
				angular.forEach(markers,function(value, key){
					if(value.position.lat()==$scope.selectedPlace.lat && value.position.lng()) //Nếu điểm trong danh sách là điểm click
					{
						var oldMarker=value;
					}
					//alert($scope.selectedPlace.name);
					value.setMap(null);
				});
				setTimeout(function(){alert('Select new place for '+$scope.selectedPlace.name);}, 500); //Delay
			}
			else
				alert('Please chose marker to replace!');
		}
	});
	</script>
</body>
</html>