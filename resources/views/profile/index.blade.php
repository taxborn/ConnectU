@extends('templates.default')

@section('title')
	Profile
@stop

@section('content')
	<div class="row">
		<!-- User information and statuses -->
		<div class="col s12 m9 l7">
			<div class="card-panel grey lighten-5 z-depth-1">
				<div class="row valign-wrapper">
					<div class="col s2">
						<img src="{{ $user->getAvatarUrl(90) }}" alt="{{ $user->getNameOrUsername() }}'s profile'" class="circle responsive-img z-depth-2"> <!-- notice the "circle" class -->
					</div>
					<div class="col s10">
						<span class="black-text">
							<h4>{{ $user->getNameOrUsername() }}</h4>
							<p>
								@if ($user->biography && $user->location)
									<!-- User specified biography and locations -->
									{{ $user->getFirstNameOrUsername() }} lives in: <strong>{{ $user->location }}</strong><br>
									{{ $user->getFirstNameOrUsername() }} says: <strong>{{ $user->biography }}</strong><br>
									@if ($user->sex !== 'not-specified')
										{{ $user->getFirstNameOrUsername() }} is a: <strong style="color: {{ $user->sex === 'male' ? 'rgb(88, 136, 218)' : 'pink' }}">{{ $user->sex }}</strong>
									@endif
								@elseif ($user->location && $user->biography === NULL)
									<!-- User specified only location -->
									{{ $user->getFirstNameOrUsername() }} lives in: {{ $user->location }}<br>
									@if ($user->sex !== 'not-specified')
										{{ $user->getFirstNameOrUsername() }} is a: <strong style="color: {{ $user->sex === 'male' ? 'rgb(88, 136, 218)' : 'pink' }}">{{ $user->sex }}</strong>
									@endif
								@elseif ($user->biography && $user->location === NULL)
									<!-- User specified only biography -->
									{{ $user->getFirstNameOrUsername() }} says: {{ $user->biograpy }}<br>
									@if ($user->sex !== 'not-specified')
										{{ $user->getFirstNameOrUsername() }} is a: <strong style="color: {{ $user->sex === 'male' ? 'rgb(88, 136, 218)' : 'pink' }}">{{ $user->sex }}</strong>
									@endif
								@elseif ($user->sex !== 'not-specified')
									{{ $user->getFirstNameOrUsername() }} is a: <strong style="color: {{ $user->sex === 'male' ? 'rgb(88, 136, 218)' : 'pink' }}">{{ $user->sex }}</strong>
								@else

								@endif
							</p>
						</span>
					</div>
				</div>
			</div>
			@if (!$statuses->count())
				<p>There is nothing in your timeline, yet.</p>
			@else
				@foreach($statuses as $status)
						<div class="col s12 m12 l12">
							<div class="card-panel grey lighten-5 z-depth-1">
								<div class="row valign-wrapper">
									<div class="col s2">
										<img src="{{ $status->user->getAvatarUrl(90) }}" alt="{{ $status->user->getNameOrUsername() }}" class="circle responsive-img z-index-2"> <!-- notice the "circle" class -->
									</div>
									<div class="col s10">
										<h5><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h5>
										<span class="black-text">
											{!! $status->body !!}
											@if ($status->user_id === Auth::user()->id || Auth::user()->hasPosition('mod', 'admin'))
												<!-- Dropdown Trigger -->
												<a class='dropdown-button btn right' href='#' data-activates='dropdown-{{ $status->id }}'><i class="material-icons">keyboard_arrow_down</i></a>

												<!-- Dropdown Structure -->
												<ul id='dropdown-{{ $status->id }}' class='dropdown-content'>
													<li><a href="{{ route('status.delete', ['statusId' => $status->id]) }}">Delete</a></li>
													<li><a href="{{ route('status.edit', ['statusId' => $status->id]) }}">Edit</a></li>
												</ul>
											@endif
											<p>
												<ul>
													@if($status->edited === 0)
														<li>{{ $status->created_at->diffForHumans() }} <br><br><a href="{{ route('status.like', ['statusId' => $status->id]) }}" class="btn indigo right">{{ $status->likes()->count() }} {{ str_plural('like', $status->likes()->count()) }}</a></li>
													@else
														<li>{{ $status->created_at->diffForHumans() }} | <em>Updated: {{ $status->updated_at->diffForHumans() }}</em> <br><br><a href="{{ route('status.like', ['statusId' => $status->id]) }}" class="btn indigo right">{{ $status->likes()->count() }} {{ str_plural('like', $status->likes()->count()) }}</a></li>
													@endif

												</ul>
											</p>
										</span>
									</div>
								</div>
							</div>
						</div>
						<!-- Replies -->
						@foreach ($status->replies as $reply)
						<div class="col s11 m11 l11 right">
							<div class="card-panel grey lighten-5 z-depth-1">
								<div class="row valign-wrapper">
									<div class="col s2">
										<img src="{{ $reply->user->getAvatarUrl(90) }}" alt="{{ $reply->user->getNameOrUsername() }}" class="circle responsive-img"> <!-- notice the "circle" class -->
									</div>
									<div class="col s10">
										<h5><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
										<span class="black-text">
											{!! $reply->body !!}
											@if ($reply->user_id === Auth::user()->id || Auth::user()->hasPosition('mod', 'admin'))
												<!-- Dropdown Trigger -->
												<a class='dropdown-button btn right' href='#' data-activates='dropdown-{{ $reply->id }}'><i class="material-icons">keyboard_arrow_down</i></a>

												<!-- Dropdown Structure -->
												<ul id='dropdown-{{ $reply->id }}' class='dropdown-content'>
													<li><a href="{{ route('status.delete', ['statusId' => $reply->id]) }}">Delete</a></li>
													<li><a href="{{ route('status.edit', ['statusId' => $reply->id]) }}">Edit</a></li>
												</ul>
											@endif
											<p>
												<ul>
													@if($reply->edited === 0)
														<li>{{ $reply->created_at->diffForHumans() }} <br><br><a href="{{ route('status.like', ['statusId' => $reply->id]) }}" class="btn indigo right">{{ $reply->likes()->count() }} {{ str_plural('like', $reply->likes()->count()) }}</a></li>
													@else
														<li>{{ $reply->created_at->diffForHumans() }} | <em>Updated: {{ $reply->updated_at->diffForHumans() }}</em> <br><br><a href="{{ route('status.like', ['statusId' => $reply->id]) }}" class="btn indigo right">{{ $reply->likes()->count() }} {{ str_plural('like', $reply->likes()->count()) }}</a></li>
													@endif
												</ul>
											</p>
										</span>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						<div class="col s11 m11 l11 right">
							<div class="card-panel grey lighten-5 z-depth-1">
								<div class="row valign-wrapper">
									<div class="col s2">
										<img src="{{ Auth::user()->getAvatarUrl(90) }}" alt="{{ Auth::user()->getNameOrUsername() }}" class="circle responsive-img"> <!-- notice the "circle" class -->
									</div>
									<div class="col s10">
										<form class="" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
											<div class="row">
												<div class="input-field col s12">
													<textarea id="textarea1" class="materialize-textarea" name="reply-{{ $status->id }}"></textarea>
													<label for="textarea1">Reply to this status</label>
													@if ($errors->has('reply-{{ $status->id }}'))
														<span class="help-block">{{ $errors->first('reply-$status->id') }}</span>
													@endif
													<button type="submit" class="waves-effect waves-light btn indigo darken-1">Reply</button>
													<input type="hidden" name="_token" value="{{ Session::token() }}">
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
				@endforeach

			@endif
		</div>
		<!-- Users friends -->
		<div class="col s12 m3 l5">
			@if (Auth::user()->hasFriendRequestPending($user))
				<br>
				<button type="button" class="btn indigo disabled center col s12">Waiting for {{ $user->getFirstNameOrUsername() }} to accept your request.</button>
				<br>
				<br>
			@elseif (Auth::user()->hasFriendRequestReceived($user))
				<br>
				<a href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn green darken-1 center col s12">Accept Friend Request</a>
				<br>
				<br>
			@elseif (Auth::user()->isFriendsWith($user))
				<br>
  				<a href="{{ route('friends.remove', ['username' => $user->username]) }}" class="btn red darken-2 center col s12">Remove friend</a>
 				<br>
 				<br>
			@elseif (Auth::user()->id !== $user->id)
				<br>
				<a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn indigo center col s12">Add as friend</a>
				<br>
				<br>
			@endif
			<div class="card-panel grey lighten-5 z-depth-1">
				<div class="row valign-wrapper">
					<div class="col s12">
						<span class="black-text">
							<p>
								@if ($user->last_activity !== "0000-00-00 00:00:00")
									<strong class="center">{{ $user->getFirstNameOrUsername() }}'s last activity:</strong>  {{ $user->last_activity->diffForHumans() }}
								@else
									<p>{{ $user->getFirstNameOrUsername() }} hasen't done much for a while.</p>
								@endif
								<hr>
								@if (!$user->friends()->count())
									<p class="text-center">{{ $user->getFirstNameOrUsername() }} has no friends</p>
								@else
									@foreach ($user->friends() as $userb)
										<div class="row">
											<div class="col s2">
												<img src="{{ $userb->getAvatarUrl(45) }}" alt="{{ $userb->getNameOrUsername() }}'s profile'" class="circle responsive-img z-depth-2"> <!-- notice the "circle" class -->
											</div>
											<div class="col s10">
												<h5 style="margin-top: 3px;"><a href="{{ route('profile.index', ['username' => $userb->username]) }}">{{ $userb->getNameOrUsername() }}</a></h5>
											</div>
										</div>
									@endforeach
								@endif
							</p>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
