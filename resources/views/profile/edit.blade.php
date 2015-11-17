@extends('templates.default')

@section('title')
	Update
@stop

@section('content')
	<h3>Update your profile</h3>

	<div class="row">
		<div class="col s12 m8 l6">
			<form action="{{ route('profile.edit') }}" method="post">
				<div class="row">
					<div class="input-field col s6">
						<i class="material-icons prefix" style="margin-top: 10px;">account_circle</i>
						<input placeholder="Last Name" id="icon_prefix last_name" type="text" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}" name="first_name">
						<label for="icon_prefix">First Name</label>
						@if ($errors->has('first_name'))
							<span class="help-block">{{ $errors->first('first_name') }}</span>
						@endif
					</div>
					<div class="input-field col s6">
						<i class="material-icons prefix" style="margin-top: 10px;">account_circle</i>
						<input placeholder="Last Name" id="icon_prefix last_name" type="text" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}" name="last_name">
						<label for="icon_prefix">Last Name</label>
						@if ($errors->has('last_name'))
							<span class="help-block">{{ $errors->first('last_name') }}</span>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<i class="material-icons prefix" style="margin-top: 10px;">assignment_ind</i>
						<input placeholder="Username" id="icon_prefix username" type="text" value="{{ Request::old('username') ?: Auth::user()->username }}" name="username">
						<label for="icon_prefix">Username</label>
						@if ($errors->has('username'))
							<span class="help-block">{{ $errors->first('username') }}</span>
						@endif
					</div>
					<div class="input-field col s6">
						<i class="material-icons prefix" style="margin-top: 10px;">email</i>
						<input placeholder="Email" id="icon_prefix email" type="text" value="{{ Request::old('email') ?: Auth::user()->email }}" name="email">
						<label for="icon_prefix">Email</label>
						@if ($errors->has('email'))
							<span class="help-block">{{ $errors->first('email') }}</span>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<i class="material-icons prefix" style="margin-top: 10px;">location_on</i>
						<input placeholder="Location" id="icon_prefix location" type="text" value="{{ Request::old('location') ?: Auth::user()->location }}" name="location">
						<label for="icon_prefix">Location</label>
						@if ($errors->has('location'))
							<span class="help-block">{{ $errors->first('location') }}</span>
						@endif
					</div>
					<div class="input-field col s6">
						<select>
							<option value="not-specified" disabled selected>{{ Auth::user()->sex !== NULL ? Auth::user()->sex : 'Choose your gender.' }}</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
						<label>Sex</label>
						@if ($errors->has('sex'))
							<span class="help-block">{{ $errors->first('sex') }}</span>
						@endif
					</div>
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix" style="margin-top: 10px;">chat</i>
					<input placeholder="Biography" id="icon_prefix biography" type="text" value="{{ Request::old('biograpy') ?: Auth::user()->biography }}" name="biography">
					<label for="icon_prefix">Biography</label>
					@if ($errors->has('biographt'))
						<span class="help-block">{{ $errors->first('biography') }}</span>
					@endif
				</div>
			</form>
		</div>
		<div class="col s12 m4 l6">
			<a class="dropdown-button waves-effect waves-light btn col s12" href="#" data-activates="dropdown-edit"><i class="material-icons left">vpn_key</i>Advanced Options</a>
			<!-- Dropdown Structure -->
			<ul id='dropdown-edit' class='dropdown-content'>
				<li><a href="#">Delete</a></li>
				<li><a href="#">Edit</a></li>
			</ul>
		</div>
	</div>
@stop
