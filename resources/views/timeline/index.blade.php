@extends('templates.default')

@section('title')
	Home
@stop

@section('content')
	<div class="col s12">
		<div class="card-panel grey lighten-5 z-depth-1">
			<div class="row valign-wrapper">
				<div class="col s1">
					<img src="{{ Auth::user()->getAvatarUrl(90) }}" alt="{{ Auth::user()->getNameOrUsername() }}" class="circle responsive-img"> <!-- notice the "circle" class -->
				</div>
				<div class="col s11">
					<form class="" action="{{ route('status.post') }}" method="post">
						<div class="row">
							<div class="input-field col s12">
								<textarea id="textarea1" class="materialize-textarea" name="status"></textarea>
								<label for="textarea1">What's up, {{ Auth::user()->getFirstNameOrUsername() }}?</label>
								@if ($errors->has('status'))
									<span class="help-block">{{ $errors->first('status') }}</span>
								@endif
								<button type="submit" class="waves-effect waves-light btn indigo darken-1">Post Status</button>
								<input type="hidden" name="_token" value="{{ Session::token() }}">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
	        <!-- Timeline statuses and replies -->
	        @if (!$statuses->count())
				<br>
				<br>
				<h5 class="center">There is nothing in your timeline, yet. Make some friends or post something!</h5>
				<br>
				<br>
	        @else
				@foreach($statuses as $status)
						<div class="col s12 m12 l12">
							<div class="card-panel grey lighten-5 z-depth-1">
								<div class="row valign-wrapper">
									<div class="col s1">
										<img src="{{ $status->user->getAvatarUrl(90) }}" alt="{{ $status->user->getNameOrUsername() }}" class="circle responsive-img z-index-2"> <!-- notice the "circle" class -->
									</div>
									<div class="col s11">
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
									<div class="col s1">
										<img src="{{ $reply->user->getAvatarUrl(90) }}" alt="{{ $reply->user->getNameOrUsername() }}" class="circle responsive-img"> <!-- notice the "circle" class -->
									</div>
									<div class="col s11">
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
									<div class="col s1">
										<img src="{{ Auth::user()->getAvatarUrl(90) }}" alt="{{ Auth::user()->getNameOrUsername() }}" class="circle responsive-img"> <!-- notice the "circle" class -->
									</div>
									<div class="col s11">
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

				{!! $statuses->render() !!}
	        @endif
	    </div>
	</div>
@stop
