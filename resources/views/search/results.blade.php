@extends('templates.default')

@section('title')
	Results
@stop

@section('content')

	<h3 class="center">Results: "{{ Request::input('query') }}"</h3>
	<h5 class="center"><em>We retrieved {{ $user_count }}
	@if ($user_count === 0 || $user_count > 1)
		results
	@else
		result
	@endif
	</em></h5>
	@if (!$users->count())
		<p>No results found.</p>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	@else
		@foreach($users as $user)
		<div class="row">
			<div class="col m2 l2">
				&nbsp;
			</div>
			<div class="col s12 m8 l8">
				<div class="card-panel grey lighten-5 z-depth-1 row">
					<div class="row valign-wrapper">
						<div class="col s2">
							<img src="{{ $user->getAvatarUrl(90) }}" alt="{{ $user->getNameOrUsername() }}" class="circle responsive-img z-index-2"> <!-- notice the "circle" class -->
						</div>
						<div class="col s10">
							<h3><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getNameOrUsername() }}</a></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		@if ($users->count() === 1)
			<br><br><br>
		@endif
	@endif
	<div class="row">
		<hr>
	</div>
	<div class="row">
		<div class="col s3">
            &nbsp;
        </div>
        <div class="col s6 center">
            <form action="{{ route('search.results') }}" method="get">
				<div class="input-field col s12">
					<i class="material-icons prefix" style="margin-top: 10px;">search</i>
					<input placeholder="Search for a user" id="icon_prefix biography" type="text" name="query">
					<label for="icon_prefix">Search</label>
				</div>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
	</div>
@stop
