@extends('templates.default')

@section('title')
	Change Password
@stop

@section('content')
	<h3 class="center">Change your Password</h3>
	<br>
	<br>
	<div class="row">
		<div class="col s3">
			&nbsp;
		</div>
		<div class="col s6">
			<form action="{{ route('profile.password') }}" method="post">
				<div class="col s12">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="margin-top: 10px;">build</i>
						<input placeholder="Your old password" id="icon_prefix password" type="password" name="oldpassword">
						<label for="icon_prefix">Old password</label>
						@if ($errors->has('oldpassword'))
							<span class="help-block">{{ $errors->first('oldpassword') }}</span>
						@endif
					</div>
				</div>
				<div class="col s12">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="margin-top: 10px;">build</i>
						<input placeholder="Your New Password" id="icon_prefix newpassword" type="password" name="newpassword">
						<label for="icon_prefix">New password</label>
						@if ($errors->has('newpassword'))
							<span class="help-block">{{ $errors->first('newpassword') }}</span>
						@endif
					</div>
				</div>
				<div class="col s12">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="margin-top: 10px;">build</i>
						<input placeholder="Your New Password(again)" id="icon_prefix newpassword" type="password" name="newpassword2">
						<label for="icon_prefix">New password(again)</label>
						@if ($errors->has('newpassword2'))
							<span class="help-block">{{ $errors->first('newpassword2') }}</span>
						@endif
					</div>
				</div>
				<div class="col s12">
					<button class="btn waves-effect waves-light center col s12 indigo darken-2" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>
	<br>
@stop
