@extends('templates.default')

@section('title')
	Results
@stop

@section('content')
	<h3>Results: "{{ Request::input('query') }}"</h3>
	<h5><em>We retrieved {{ $user_count }}
	@if ($user_count === 0 || $user_count > 1)
		results
	@else
		result
	@endif
	</em></h5>
	@if (!$users->count())
		<p>No results found.</p>
	@else
		<div class="row">
			<div class="col-lg-12">
				@foreach ($users as $user)
					@include('user.partials.userblock')
				@endforeach
				{!! $users->render() !!}
			</div>
		</div>
	@endif
@stop
