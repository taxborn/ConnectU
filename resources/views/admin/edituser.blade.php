@extends('templates.default')

@section('title')
	Update
@stop

@section('content')
	<h3>Editing user: <a href="{{ route('profile.index', ['username' => $user->username]) }}" target="_blank">{{ $user->getNameOrUsername() }}</a>&nbsp;<span class="label label-pink">{{ $user->position }}</span></h3>

	<div class="row">
	    <div class="col-lg-6">
	        <form class="form-vertical" role="form" method="post" action="{{ route('profile.edit') }}">
	            <div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
	                        <label for="first_name" class="control-label">First name</label>
	                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}">
	                    	@if ($errors->has('first_name'))
								<span class="help-block">{{ $errors->first('first_name') }}</span>
	                    	@endif
	                    </div>
	                </div>
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
	                        <label for="last_name" class="control-label">Last name</label>
	                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}">
	                    	@if ($errors->has('last_name'))
								<span class="help-block">{{ $errors->first('last_name') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
	                        <label for="username" class="control-label">Username</label>
	                        <input type="text" name="username" class="form-control" id="username" value="{{ Request::old('username') ?: Auth::user()->username }}">
	                    	@if ($errors->has('username'))
								<span class="help-block">{{ $errors->first('username') }}</span>
	                    	@endif
	                    </div>
	                </div>
	                <div class="col-lg-6">
	                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
	                        <label for="email" class="control-label">Email</label>
	                        <input type="text" name="email" class="form-control" id="email" value="{{ Request::old('email') ?: Auth::user()->email }}">
	                    	@if ($errors->has('email'))
								<span class="help-block">{{ $errors->first('email') }}</span>
	                    	@endif
	                    </div>
	                </div>
	            </div>
				<div class="row">
					<div class="col-lg-6">
						<label for="location" class="control-label">Location</label>
						<input type="text" name="location" class="form-control" id="location" value="{{ Request::old('location') ?: Auth::user()->location }}">
						@if ($errors->has('location'))
							<span class="help-block">{{ $errors->first('location') }}</span>
						@endif
					</div>
					<div class="col-lg-6">
						<label for="gender">Gender</label>
						<select class="form-control" name="gender">
							@if ($user->gender === 'male')
								<option value="male">Male</option>
								<option value="female">Female</option>
							@elseif ($user->gender === 'female')
								<option value="female">Female</option>
								<option value="male">Male</option>
							@endif
							<option value="not-specified">Not Specified</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
				</div>
	            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
	                <label for="location" class="control-label">Location</label>
	                <input type="text" name="location" class="form-control" id="location" value="{{ Request::old('location') ?: Auth::user()->location }}">
	            	@if ($errors->has('location'))
						<span class="help-block">{{ $errors->first('location') }}</span>
	                @endif
	            </div>
	            <div class="form-group {{ $errors->has('biography') ? 'has-error' : '' }}">
	                <label for="biography" class="control-label">Biography</label>
	                <input type="text" name="biography" class="form-control" id="biography" value="{{ Request::old('biography') ?: Auth::user()->biography }}">
	            	@if ($errors->has('biography'))
						<span class="help-block">{{ $errors->first('biography') }}</span>
	                @endif
	            </div>
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary">Update</button>
	            </div>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	        </form>
	    </div>
		<div class="col-lg-6">
			<a href="{{ route('admin.userpassword', ['username' => $user->username]) }}"><button class="btn btn-block btn-primary">Edit user password</button></a>
			<br>
			<a href="{{ route('admin.promote', ['userId' => $user->id]) }}"><button class="btn btn-block btn-warning">Promote User</button></a>
			<br>
			<a href="{{ route('admin.demote', ['userId' => $user->id]) }}"><button class="btn btn-block btn-danger">Demote User</button></a>
		</div>
	</div>
@stop
