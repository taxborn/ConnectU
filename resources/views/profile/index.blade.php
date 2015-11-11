@extends('templates.default')

@section('title')
	Profile
@stop

@section('content')
	<div class="row">
	    <div class="col-lg-8">
	        <!-- User information and statuses -->
	        @include('user.partials.userblock')
			@if ($user->biography && $user->location)
				<br>
				<div class="well well-sm">
					@if ($user->gender !== 'not-specified')
			            @if ($user->gender === 'male')
			                <span class="label label-primary">Male</span> |
			            @elseif ($user->gender === 'female')
			                <span class="label label-pink">Female</span> |
			            @endif
			        @endif
					<b>{{ $user->location }}</b> | {{ $user->biography }}
				</div>
			@elseif ($user->location)
				<br>
				<div class="well well-sm">
					@if ($user->gender !== 'not-specified')
			            @if ($user->gender === 'male')
			                <span class="label label-primary">Male</span> |
			            @elseif ($user->gender === 'female')
			                <span class="label label-pink">Female</span> |
			            @endif
			        @endif
					{{ $user->location }}
				</div>
			@elseif ($user->biography)
				<br>
				<div class="well well-sm">
					@if ($user->gender !== 'not-specified')
			            @if ($user->gender === 'male')
			                <span class="label label-primary">Male</span> |
			            @elseif ($user->gender === 'female')
			                <span class="label label-pink">Female</span> |
			            @endif
			        @endif
					{{ $user->biography }}
				</div>
			@endif
	        <hr>
	        <!-- Statuses -->
	        @if (!$statuses->count())
				<p>{{ $user->getFirstNameOrUsername() }} hasn't posted anything yet.</p>
	        @else
				@foreach($statuses as $status)
					<div class="media">
					    <a class="pull-left" href="#">
					        <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
					    </a>
					    <div class="media-body">
					        <h5 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h5>
					        <p>{!! $status->body !!}</p>
							@if ($status->user_id === Auth::user()->id || Auth::user()->isStaff(Auth::user()))
								<div class="{{ ($status->replies->count() !== 0 ? 'dropdown' : 'dropup') }} pull-right">
									<button class="btn btn-primary dropdown-toggle" type="button" id="ddm1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class="glyphicon {{ ($status->replies->count() !== 0 ? 'glyphicon-chevron-down' : 'glyphicon-chevron-up') }}"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="ddm1">
										<li><a href="{{ route('status.delete', ['statusId' => $status->id]) }}">Delete Post</a></li>
										<li><a href="{{ route('status.edit', ['statusId' => $status->id]) }}">Edit Post</a></li>
									</ul>
								</div>
							@endif
					        <ul class="list-inline">
					        	@if($status->edited === 0)
					            	<li>{{ $status->created_at->diffForHumans() }}</li>
					            @else
									<li>{{ $status->created_at->diffForHumans() }} | <em>Updated: {{ $status->updated_at->diffForHumans() }}</em></li>
					            @endif
						        <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
					            <li>{{ $status->likes()->count() }} {{ str_plural('like', $status->likes()->count()) }}</li>
					        </ul>
							<!-- Replies -->
							@foreach($status->replies as $reply)
					        <div class="media">
					            <a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
					                <img class="media-object" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
					            </a>
					            <div class="media-body">
					                <h6 class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h6>
					                <p>{!! $reply->body !!}</p>
									@if ($status->user_id === Auth::user()->id || Auth::user()->isStaff(Auth::user()))
										<div class="dropup pull-right">
											<button class="btn btn-primary dropdown-toggle" type="button" id="ddm1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
												<span class="glyphicon glyphicon-chevron-up"></span>
											</button>
											<ul class="dropdown-menu" aria-labelledby="ddm1">
												<li><a href="{{ route('status.delete', ['statusId' => $reply->id]) }}">Delete Post</a></li>
												<li><a href="{{ route('status.edit', ['statusId' => $reply->id]) }}">Edit Post</a></li>
											</ul>
										</div>
									@endif
					                <ul class="list-inline">
						        	@if($reply->edited === 0)
						            	<li>{{ $reply->created_at->diffForHumans() }}</li>
						            @else
										<li>{{ $reply->created_at->diffForHumans() }} | <em>Updated: {{ $reply->updated_at->diffForHumans() }}</em></li>
						            @endif
										<li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Like</a></li>
					                    <li>{{ $reply->likes()->count() }} {{ str_plural('like', $reply->likes()->count()) }}</li>
					                </ul>
					            </div>
					        </div>
					        @endforeach

					        @if ($authUserIsFriend || Auth::user()->id === $status->user->id)
								<!-- Reply Area -->
								<br>
						        <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
						            <div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
						                <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status""></textarea>
						            	@if ($errors->has("reply-{$status->id}"))
											<span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
						            	@endif
						            </div>
						            <input type="hidden" name="_token" value="{{ Session::token() }}">
						            <input type="submit" value="Reply" class="btn btn-primary btn-sm">
						        </form>
						        <br>
					        @endif
					    </div>
					</div>
				@endforeach
	        @endif
	    </div>
	    <div class="col-lg-4">
	        <!-- Friends, friend requests -->
			@if ($user->last_login !== "0000-00-00 00:00:00")
				<b class="text-center">{{ $user->getFirstNameOrUsername() }}'s last activity:</b>  {{ $user->last_login->diffForHumans() }}
			@else
				<p>{{ $user->getFirstNameOrUsername() }} hasen't done much for a while.</p>
			@endif
			@if (Auth::user()->hasFriendRequestPending($user))
				<button type="button" class="btn btn-block text-center btn-success" disabled>Waiting for {{ $user->getFirstNameOrUsername() }} to accept your request.</button>
				<br>
			@elseif (Auth::user()->hasFriendRequestReceived($user))
				<a href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn btn-success btn-block text-center">Accept Friend Request</a>
				<br>
			@elseif (Auth::user()->isFriendsWith($user))
  				<a href="{{ route('friends.remove', ['username' => $user->username]) }}" class="btn btn-danger btn-block text-center">Remove friend</a>
 				<br>
			@elseif (Auth::user()->id !== $user->id)
				<a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-primary btn-block text-center">Add as friend</a>
				<br>
			@endif
	        <div class="panel panel-primary">
	        	<div class="panel-heading">
	        		<h5 class="text-center" style="color: white;">{{ $user->getFirstNameOrUsername() }}'s friends.</h5>
	        	</div>
	        	<div class="panel-body">
	        		 @if (!$user->friends()->count())
						<p class="text-center">{{ $user->getFirstNameOrUsername() }} has no friends</p>
			        @else
						@foreach ($user->friends() as $user)
							@include('user.partials.userblock')
						@endforeach
			        @endif
	        	</div>
	        </div>
	    </div>
	</div>
@stop
