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
			<div class="col-sm-6">
				<div id="googleMap" style="width: auto; height: 460px; border: solid 1px; border-color: white;"></div>
			</div>
			<div class="col-sm-6">
				<button id="btnAddInfo" type="button" class="btn btn-info">Add info</button>
				<div id="pnInfo" class="panel panel-info" style="margin-top: 5px;">
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
		<!-- Button reset marker
		<div class="row" style="margin-top: 20px;">
			<div class="col-sm-6 col-sm-offset-3">
				<button id="btnResetMarker" type="button" class="btn btn-success">Reset mark</button>
			</div>
		</div>
		-->
	</div>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/googlemap/create.js"></script>
</body>
</html>