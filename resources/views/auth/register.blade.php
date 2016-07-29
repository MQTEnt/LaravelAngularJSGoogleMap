@extends('auth.master')
@section('head.title')
Register
@stop
@section('panel.title')
Register
@stop
@section('panel.content')
<form class="form-horizontal" method="POST" action="{{route('postRegister')}}">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
		<label class="col-sm-3 control-label">Name:</label>
		<div class="col-sm-8">
			<input type="text" name="name" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Email:</label>
		<div class="col-sm-8">
			<input type="email" name="email" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Password:</label>
		<div class="col-sm-8">
			<input type="password" name="password" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">Re-Password:</label>
		<div class="col-sm-8">
			<input type="password" name="password_confirmation" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-8">
			<input type="submit" value="Register" class="col-sm-3 col-sm-offset-5 btn btn-success">
		</div>
	</div>
</form>
@stop