@extends('templates.default')

@section('title')
	Search..
@stop

@section('content')
    <div class="row">
		<h1 class="center">Search for a user...</h1>
		<hr>
		<br>
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
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
@stop
