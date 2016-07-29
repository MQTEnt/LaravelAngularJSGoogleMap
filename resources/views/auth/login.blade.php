@extends('auth.master')
@section('head.title')
Login
@stop
@section('panel.title')
Login
@stop
@section('panel.content')
<form class="form-horizontal" method="POST" action="{{route('postLogin')}}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
		<label class="col-sm-2 col-sm-offset-1 control-label">E-mail:</label>
		<div class="col-sm-8">
			<input type="text" name="email" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 col-sm-offset-1 control-label">Password:</label>
		<div class="col-sm-8">
			<input type="password" name="password" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-8">
			<input type="submit" value="Login" class="col-sm-3 col-sm-offset-5 btn btn-success">
		</div>
		<div class="col-sm-2">
			<a href="{{route('getRegister')}}" class="col-sm-3 pull-right"><span class="glyphicon glyphicon-pencil">Register</span></a>
		</div>
	</div>
</form>
@stop