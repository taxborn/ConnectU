@extends('templates.default')

@section('title')
	Signin
@stop

@section('content')
	<div class="content">
		<h3 class="center">Sign in</h3>
		<div class="row">
			<div class="col s12 center">
				<form action="{{ route('auth.signin') }}" method="post">
					<div class="input-field col s6">
			          	<i class="material-icons prefix">account_circle</i>
			          	<input id="icon_prefix email" type="text" value="{{ Request::old('email') ?: '' }}" name="email">
			          	<label for="icon_prefix">Username or Email</label>
						@if ($errors->has('email'))
							<span class="help-block">{{ $errors->first('email') }}</span>
		                @endif
			        </div>
					<div class="input-field col s6">
			          	<i class="material-icons prefix">memory</i>
			          	<input id="icon_prefix password" type="password" name="password">
			          	<label for="icon_prefix">Password</label>
						@if ($errors->has('password'))
							<span class="help-block">{{ $errors->first('password') }}</span>
		                @endif
			        </div>
					<p class="center">
				      	<input type="checkbox" id="test6" checked="checked" />
				      	<label for="test6">Remember Me</label>
				    </p>
					<button type="submit" class="waves-effect waves-light btn">Signin</button>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
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
