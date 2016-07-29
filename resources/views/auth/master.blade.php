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