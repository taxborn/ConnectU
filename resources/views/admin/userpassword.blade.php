@extends('templates.default')

@section('title')
	Change User Password
@stop

@section('content')
	<h3>Change {{ $user->getFirstNameOrUsername() }}'s Password</h3>
	<br>
	<div class="row">
	    <div class="col-lg-6">
	        <form class="form-vertical" role="form" method="post" action="{{ route('admin.userpassword') }}">
				<div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('newpassword') ? 'has-error' : '' }}">
	                        <label for="newpassword" class="control-label">New Password</label>
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
	                        <label for="newpassword2" class="control-label">New Password(again)</label>
	                        <input type="password" name="newpassword2" class="form-control" id="newpassword2">
	                    	@if ($errors->has('newpassword2'))
								<span class="help-block">{{ $errors->first('newpassword2') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-danger">Change Password</button>
	            </div>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	            <input type="hidden" name="username" value="{{ $user->username }}">
	        </form>
	    </div>
	</div>
@stop