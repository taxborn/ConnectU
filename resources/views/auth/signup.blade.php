@extends('templates.default')

@section('title')
	Signup
@stop

@section('content')
<div class="container">
	<h3 class="center">Sign up</h3>
	<div class="row">
		<div class="col s12 center">
			<form action="{{ route('auth.signup') }}" method="post">
				<div class="input-field col s12">
					<i class="material-icons prefix" style="margin-top: 10px;">email</i>
					<input placeholder="Email" id="icon_prefix email" type="text" value="{{ Request::old('email') ?: '' }}" name="email">
					<label for="icon_prefix">Your email address</label>
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix" style="margin-top: 10px;">perm_identity</i>
					<input placeholder="Username" id="icon_prefix username" type="text" value="{{ Request::old('username') ?: '' }}" name="username">
					<label for="icon_prefix">Choose a username</label>
					@if ($errors->has('username'))
						<span class="help-block">{{ $errors->first('username') }}</span>
					@endif
				</div>
				<div class="input-field col s12">
					<i class="material-icons prefix" style="margin-top: 10px;">lock</i>
					<input placeholder="Password" id="icon_prefix password" type="password" value="{{ Request::old('password') ?: '' }}" name="password">
					<label for="icon_prefix">Create your password</label>
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="col s12">
					<p class="center">
						By signing up to ConnectU, you agree to the <a href="{{ route('guidelines') }}">Terms of Service</a>.
					</p>
					<button type="submit" class="waves-effect waves-light btn indigo darken-1">Signup</button>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
				</div>
			</form>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
</div>
@stop
