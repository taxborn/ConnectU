@extends('templates.default')

@section('title')
	Delete
@stop

@section('content')
	<h3 class="center">Delete your account</h3>
	<p class="center">Warning: This action is irreversible.</p>
	<br>
	<br>
	<div class="row">
		<div class="col s3">
			&nbsp;
		</div>
		<div class="col s6">
			<form action="{{ route('profile.delete') }}" method="post">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix" style="margin-top: 10px;">build</i>
						<input placeholder="Your password" id="icon_prefix password" type="password" name="password">
						<label for="icon_prefix">Password</label>
						@if ($errors->has('password'))
							<span class="help-block">{{ $errors->first('password') }}</span>
						@endif
					</div>
					<div class="col s12">
						<button class="btn waves-effect waves-light center col s12 indigo darken-2" type="submit" name="action">Submit
							<i class="material-icons right">send</i>
						</button>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
	</div>
		<br>
		<br>
		<br>
@stop
