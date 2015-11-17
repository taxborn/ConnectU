@extends('templates.default')

@section('title')
	Edit Status
@stop

@section('content')
	<div class="row">
		<br>
		<form class="col s8" action="{{ route('status.edit', ['statusId' => $status->id]) }}" method="post">
			<div class="row">
				<div class="input-field col s12">
					<label for="textarea1">Status</label>
					<textarea id="textarea1" class="materialize-textarea" name="status">{!! $status->body !!}</textarea>
				</div>
			</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
			<input type="hidden" name="statusId" value="{{ $status->id }}">
			<button type="submit" class="btn indigo darken-1">Update status</button>
		</form>
		<div class="col s4">
			<a href="{{ route('status.delete', ['statusId' => $status->id]) }}" class="btn waves-effect waves-light btn-large red darken-2 col s12">Delete Post</a>
		</div>
	</div>
	<div class="row">
		<h3 class="center">Your post statistics</h3>
		<div class="col s6 center">
			<i class="material-icons" style="font-size: 60px;">favorite</i><br>
			<strong>Likes</strong>
			<p>
				@if (Auth::user()->friends()->count() === 0)
					You have no friends currently, make some to see thse statistics!
				@else
					{{ $x = ($status->likes()->count()) / (Auth::user()->friends()->count()) }}
					Your post has {{ $status->likes()->count() }} out of {{ Auth::user()->friends()->count() }} possible likes! That is {{ sprintf("%.2f%%", $x * 100) }}!
				@endif
			</p>
		</div>
		<div class="col s6 center">
			<i class="material-icons" style="font-size: 60px;">favorite</i><br>
			<strong>Viewing</strong>
			<p>
				Your post can be seen by {{ Auth::user()->friends()->count() }}
				@if (Auth::user()->friends()->count() === 0 || Auth::user()->friends()->count() > 1)
					users
				@else
					user
				@endif
			</p>
		</div>
	</div>
@stop
