@extends('templates.default')

@section('title')
	Change Password
@stop

@section('content')
	<h3>Change your Password</h3>
	<br>
	<br>
	<div class="row">
	    <div class="col-lg-6">
	        <form class="form-vertical" role="form" method="post" action="{{ route('profile.password') }}">
	            <div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('oldpassword') ? 'has-error' : '' }}">
	                        <label for="oldpassword" class="control-label">Your old password</label>
	                        <input type="password" name="oldpassword" class="form-control" id="oldpassword">
	                    	@if ($errors->has('oldpassword'))
								<span class="help-block">{{ $errors->first('oldpassword') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
				<div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('newpassword') ? 'has-error' : '' }}">
	                        <label for="newpassword" class="control-label">Your new password</label>
	                        <input type="password" name="newpassword" class="form-control" id="newpassword">
	                    	@if ($errors->has('newpassword'))
								<span class="help-block">{{ $errors->first('newpassword') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
				<div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('newpassword2') ? 'has-error' : '' }}">
	                        <label for="newpassword2" class="control-label">Your new password(again)</label>
	                        <input type="password" name="newpassword2" class="form-control" id="newpassword2">
	                    	@if ($errors->has('newpassword2'))
								<span class="help-block">{{ $errors->first('newpassword2') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary">Change Password</button>
	            </div>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	        </form>
	    </div>
	</div>
@stop