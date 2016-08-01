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
										<div class="col-sm-5 col-sm-offset-7">
											<div class="col-sm-4">
												<button class="btn btn-danger pull-right" ng-click="deleteMarker()"><span class="glyphicon glyphicon-trash"></span></button>
											</div>
											<div class="col-sm-3">
												<button class="btn btn-success pull-right" ng-click="editLngLat()"><span class="glyphicon glyphicon-map-marker"></span></button>
											</div>
											<div class="col-sm-5">
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
										<a href="#" class="list-group-item" ng-repeat="review in bestReviews">{{review.title}}<span class="badge">{{review.votes}}</span></a>
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
																		<input ng-model="newReview.title" type="text" class="form-control" placeholder="Fill the title">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 col-sm-offset-1">Content:</label>
																	<div class="col-sm-10 col-sm-offset-1">
																		<textarea ng-model="newReview.content" class="form-control" row="5"></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 col-sm-offset-1">Tag:</label>
																	<div class="col-sm-10 col-sm-offset-1">
																		<input ng-model="newReview.tags" type="text" class="form-control" placeholder="Eg: Park, Zoo, Beautiful...">
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-sm-11">
																		<button ng-click="addNewReview()" class="btn btn-success pull-right" type="button">Submit</button>
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
	<script src="/js/googlemap/list.js"></script>
</body>
</html>