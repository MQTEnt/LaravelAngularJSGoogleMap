<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('head.title')</title>
	<link rel="stylesheet" href="/css/mystyle.css">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<style>
		#pnHeadingLogin{
			background-color: #007399;
			color: #f2f2f2;
		}
		.panel-body{
			margin: 0;
		}
		.panel{
			border: 0px;
		}
	</style>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-default" style="margin-bottom: 150px; background-color: #ffffff;">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{route('place.index')}}">Place4me</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{{route('getLogin')}}">Login</a></li>
							<li><a href="{{route('getRegister')}}">Register</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{route('getLogout')}}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<!-- End Navbar -->

	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel">
					<div id="pnHeadingLogin" class="panel panel-heading">
						<b>@yield('panel.title')</b>
					</div>
					<div class="panel panel-body">
						<!-- Display Error -->
						@if($errors->count())
						<div class="alert alert-danger fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Error</strong>
							<ul>
								@foreach($errors->all() as $error)
								<li>{{$error}}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<!-- End Display Error -->
						
						<!-- Panel Content -->
						@yield('panel.content')
						<!-- End Panel Content -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</body>
</html>