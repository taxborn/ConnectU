<?php
	use Carbon\Carbon;
?>

@extends('templates.default')

@section('title')
	Admin
@stop

@section('content')
	<h3>Admin Panel</h3>
	<a href="{{ route('metrics') }}">Metrics</a>
	<br>

		<div class="row">
			<div class="col s12">
				<table class="highlight">
					<thead>
						<tr>
							<th data-field="id">
								User ID #
							</th>
							<th data-field="username">
								Username
							</th>
							<th data-field="email">
								Email
							</th>
							<th data-field="first_name">
								First Name
							</th>
							<th data-field="last_name">
								Last Name
							</th>
							<th data-field="ip">
								IP
							</th>
							<th data-field="last_activity">
								Last Activity
							</th>
							<th data-field="logs">
								User Logs
							</th>
							<th data-field="edit">
								Edit User
							</th>
							<th data-field="delete">
								Delete User
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>
									{{ $user->id }}
								</td>
								<td>
									<a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->username }}</a>
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
									<a href="http://whatismyipaddress.com/ip/{{ $user->ip }}">{{ $user->ip }}</a>
								</td>
								<td>
									<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="{{ $user->last_activity }}">{{ Carbon::parse($user->last_activity)->diffForHumans() }}</a>
								</td>
								<td>
									<a href="{{ route('admin.userlogs', ['username' => $user->username]) }}" class="btn indigo"><i class="material-icons">assessment</i></a>
								</td>
								<td>
									<a href="{{ route('admin.edituser', ['username' => $user->username]) }}" class="btn indigo"><i class="material-icons">build</i></a>
								</td>
								<td>
									<a href="{{ route('admin.delete.user', ['username' => $user->username]) }}" class="btn indigo"><i class="material-icons">gavel</i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	<div class="col-lg-12 text-center">
		{!! $users->render() !!}
	</div>
@stop
