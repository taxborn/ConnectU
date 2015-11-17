@extends('templates.default')

@section('title')
	Admin
@stop

@section('content')
	<h3>User logs for: {{ $user->getNameOrUsername() }}</h3>
	<a href="{{ route('admin.home') }}">Admin Panel</a>
	<br>

	<table class="table table-striped">
		<tr>
			<th>
				Post ID
			</th>
			<th>
				Is Reply?
			</th>
			<th>
				Parent ID
			</th>
			<th>
				Post Body
			</th>
			<th>
				Created At
			</th>
			<th>
				Updated At
			</th>
			<th>
				Post Options
			</th>
		</tr>
		@foreach($statuses as $status)
			<tr>
				<td>
					{{ $status->id }}
				</td>
				<td>
					@if ($status->parent_id !== NULL)
						<p>Yes</p>
					@else
						<p>No</p>
					@endif
				</td>
				<td>
					@if ($status->parent_id !== NULL)
						{{ $status->parent_id }}
					@else
						<p>NULL</p>
					@endif
				</td>
				<td>
					{!! $status->body !!}
				</td>
				<td>
					{{ $status->created_at }}
				</td>
				<td>
					{{ $status->updated_at }}
				</td>
				<td>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="ddm1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="glyphicon glyphicon-chevron-down"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="ddm1">
							<li><a href="{{ route('status.delete', ['statusId' => $status->id]) }}">Delete Post</a></li>
							<li><a href="{{ route('status.edit', ['statusId' => $status->id]) }}">Edit Post</a></li>
						</ul>
					</div>
				</td>
			</tr>
		@endforeach
	</table>
@stop
