<?php
	use Carbon\Carbon;
?>

@extends('templates.default')

@section('title')
	Moderator Panel
@stop

@section('content')
	<h3>Moderator Panel</h3>
	<a href="{{ route('metrics') }}">Metrics</a>
	<br>

	<table class="table table-striped">
		<tr>
			<th>
				User ID
			</th>
			<th>
				Username
			</th>
			<th>
				User Email
			</th>
			<th>
				User First Name
			</th>
			<th>
				User Last Name
			</th>
			<th>
				User IP
			</th>
			<th>
				Last Activity
			</th>
			<th>
				Edit User
			</th>
			<th>
				User Logs
			</th>
		</tr>
		@foreach($users as $user)
			<tr>
				<td>
					{{ $user->id }}
				</td>
				<td>
					<a href="{{ route('profile.index', ['username' => $user->username]) }}" target="_blank">{{ $user->username }}</a>
				</td>
				<td>
					<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
				</td>
				<td>
					{{ $user->first_name }}
				</td>
				<td>
					{{ $user->last_name }}
				</td>
				<td>
					{{ $user->ip }}
				</td>
				<td>
					@if ($user->last_login !== '0000-00-00 00:00:00')
						{{ Carbon::parse($user->last_login)->diffForHumans() }}
					@else
						<em><strong>Delete: 11/15/15</strong></em>
					@endif
				</td>
				<td>
					<!-- Edit user -->
					@if ($user->position !== 'admin' && $user->position !== 'mod')
						<a href="{{ route('admin.edituser', ['username' => $user->username]) }}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a>
					@endif
				</td>
				<td>
					<!-- User logs -->
					<a href="{{ route('admin.userlogs', ['username' => $user->username]) }}"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-user"></span></button></a>
				</td>
			</tr>
		@endforeach
	</table>
	<div class="col-lg-12 text-center">
		{!! $users->render() !!}
	</div>
@stop
