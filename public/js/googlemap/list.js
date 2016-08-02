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
});

//Google Map 
var map;
var myCenter=new google.maps.LatLng(21.023943953402217,105.84157705307007); //Điểm trung tâm bản đồ
var markers=[]; //Các điểm trên map
var newMarker;	//Điểm mới (dành cho chức năng sửa điểm mới)
var modeEdit=false;
var oldMarker;
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
	$scope.selectedPlace={};
	//Khai báo hàm getList() (lấy danh sách marker và hiển thị) 
	function getList()
	{
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
					//Gọi hàm để lấy review tương ứng
					getBestRevews();
					//Chú ý sử dụng $apply() để đồng bộ với controller
					$scope.$apply();
					//Hiển thị infowindow cho marker
					infowindow.open(map,marker);
				});
			});	
		});
	};
	//Gọi hàm getList();
	getList();

	//Update...
	$scope.updatePlace=function(id){
		if(typeof $scope.selectedPlace.id == 'undefined')
		{
			alert('Please choose place for updating');
			return 0;
		}
		var data; //Dữ liệu gửi tới server
		if(modeEdit==true)
		{
			//Thay đổi giá trị tọa độ (nếu có) để gửi tới server
			$scope.selectedPlace.lat=newMarker.position.lat();
			$scope.selectedPlace.lon=newMarker.position.lng();
			//console.log(data);
		}
		data=$.param($scope.selectedPlace); //Gán dữ liệu

		//console.log(data);
		$http({
			method: 'POST',
			url: '/place/'+id+'/update',
			data: data,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		})
		.success(function(response){
			//console.log(response);
			var iRemove;
			if(modeEdit==true) //Nếu có thay đổi tọa độ thì tải lại các marker
			{
				modeEdit=false;//Đồng thời tắt chế độ edit
				//Xóa tọa độ cũ, hiển thị lại các điểm trên bản đồ
				var i=0;
				angular.forEach(markers,function(value, key){
					if(value!=oldMarker)
					{
						value.setMap(map);
						i++;
					}
					else
						iRemove=i;
				});
				markers.splice(iRemove, 1)

				//Tạo điểm mới sửa
				var marker = new google.maps.Marker({
					position: {lat: newMarker.position.lat(), lng: newMarker.position.lng()},
					map: map
				});
				//Đưa vào mảng
				markers.push(marker);
				//Gán giá trị cho marker vừa sửa (bằng với các giá trị của object Angular đang chọn)
				var markerProp = $scope.selectedPlace;

				//Khai báo infowindow cho marker
				var infowindow = new google.maps.InfoWindow({
						content: $scope.selectedPlace.name
				});
				//Click marer event
				marker.addListener('click',function(){
					$scope.selectedPlace=markerProp;
					getBestRevews();
					//Chú ý sử dụng $apply() để đồng bộ với controller
					$scope.$apply();
					//Hiển thị infowindow cho marker
					infowindow.open(map,marker);
				});

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
	//Edit position of marker
	$scope.editLngLat=function(){
		if(typeof $scope.selectedPlace.id != 'undefined')
		{
			modeEdit=true; //Enable mode edit marker
			//Chạy vòng lặp để tạm thời xóa hết điểm trên bản đồ
			angular.forEach(markers,function(value, key){
				if(value.position.lat()==$scope.selectedPlace.lat && value.position.lng()) //Nếu điểm trong danh sách là điểm click
				{
					oldMarker=value;
				}
				//alert($scope.selectedPlace.name);
				value.setMap(null);
			});
			setTimeout(function(){alert('Select new place for '+$scope.selectedPlace.name);}, 500); //Delay
		}
		else
			alert('Please chose marker to replace!');
	}
	//Delete marker
	$scope.deleteMarker=function(){
		if(typeof $scope.selectedPlace.id != 'undefined')
		{
			var confirm=window.confirm('Are you sure to delete '+$scope.selectedPlace.name);
			if(confirm)
			{
				$http.get('/place/'+$scope.selectedPlace.id+'/delete').success(function(response){
					if(response==1)
					{
						alert('Delete success');
						//Tìm và xóa điểm trên map
						angular.forEach(markers,function(value, key){
							if(value.position.lat()==$scope.selectedPlace.lat&&value.position.lng()==$scope.selectedPlace.lon)
							{
								value.setMap(null);
							}
						});
					}
					else
						alert('Error');
				});
			}
		}
		else
		{
			alert('Please choose place for deleting');
		}
	};
	//Add new review
	$scope.addNewReview=function(){
		if(typeof $scope.selectedPlace.id != 'undefined')
		{
			//
			//Validate $scope.newReview trước đó tại view (Updating...): Không được để trong các input title, tags nếu không $scope.newReview sẽ undefine
			//
			var dataSend=$.param($scope.newReview);
			dataSend=dataSend+'&place_id='+$scope.selectedPlace.id; //Thêm place_id cho data gửi đi
			dataSend=dataSend+'&content='+encodeURI($('#editor').html()); //Lấy thêm conent từ editor-wysiwyg vào data gửi đi, chú ý convert từ string sang URI
			//console.log(dataSend);
			$http({
				method: 'POST',
				data: dataSend,
				url: '/review/store',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			})
			.success(function(response){
				alert(response);
				$scope.newReview.title='';
				$scope.newReview.tags='';
			})
			.error(function(){
				alert('Error');
			});
		}
		else
		{
			alert('Pleace choose marker');
		}
	};
	//List best reviews
	function getBestRevews()
	{
		$http.get('/bestReviews/'+$scope.selectedPlace.id)
		.success(function(response){
			$scope.bestReviews=response;
		});
	};
});