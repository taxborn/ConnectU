@extends('templates.default')

@section('title')
	Home
@stop

@section('content')
	<div class="row">
	    <div class="col-lg-12">
	        <form role="form" action="{{ route('status.post') }}" method="post">
	            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
	                <textarea name="status" class="form-control" rows="2" id="froala-editor"></textarea>
	            	@if ($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
	            	@endif
	            </div>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	            <button type="submit" class="btn btn-primary">Update status</button>
	        </form>
	        <hr>
	    </div>
	</div>

	<div class="row">
	    <div class="col-lg-12">
	        <!-- Timeline statuses and replies -->
	        @if (!$statuses->count())
				<p>There is nothing in your timeline, yet.</p>
	        @else
				@foreach($statuses as $status)
					<div class="media">
					    <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
					        <img class="media-object" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}" style="border-radius: 5px;">
					    </a>
					    <div class="media-body" id="status-{{ $status->id }}">
					        <h5 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h5>

							{!! $status->body !!}
							@if ($status->user_id === Auth::user()->id || Auth::user()->isStaff(Auth::user()))
								<div class="dropdown pull-right">
									<button class="btn btn-primary dropdown-toggle" type="button" id="ddm1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										<span class="glyphicon glyphicon-chevron-down"></span>
									</button>
									<ul class="dropdown-menu" aria-labelledby="ddm1">
										<li><a href="{{ route('status.delete', ['statusId' => $status->id]) }}">Delete Post</a></li>
										<li><a href="{{ route('status.edit', ['statusId' => $status->id]) }}">Edit Post</a></li>
									</ul>
								</div>
							@endif
					        <ul class="list-inline">
					        	@if($status->edited === 0)
					            	<li>{{ $status->created_at->diffForHumans() }}
										@if ($status->deleted === 1 && Auth::user()->isModAndUp(Auth::user()))
											| <span class="label label-default">Deleted</span>
										@endif
									</li>
					            @else
									<li>{{ $status->created_at->diffForHumans() }} | <em>Updated: {{ $status->updated_at->diffForHumans() }}</em>
										@if ($status->deleted === 1 && Auth::user()->isModAndUp(Auth::user()))
											| <span class="label label-default">Deleted</span>
										@endif
									</li>
					            @endif
						        <li><a href="{{ route('status.like', ['statusId' => $status->id]) }}">Like</a></li>
						        <li>{{ $status->likes()->count() }} {{ str_plural('like', $status->likes()->count()) }}</li>
					        </ul>
							<!-- Replies -->
							@foreach($status->replies as $reply)
					        <div class="media">
					            <a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
					                <img class="media-object" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}"  style="border-radius: 5px;">
					            </a>
					            <div class="media-body">
					                <h6 class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h6>
					                <p style="margin-top: 12px;">{!! $reply->body !!}</p>
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
							<!-- Reply Area -->
							<br>
					        <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
					            <div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : '' }}">
					                <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
					            	@if ($errors->has("reply-{$status->id}"))
										<span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span>
					            	@endif
					            </div>
					            <input type="hidden" name="_token" value="{{ Session::token() }}">
					            <input type="submit" value="Reply" class="btn btn-primary btn-sm">
					        </form>
					        <br>
					    </div>
					</div>
				@endforeach

				{!! $statuses->render() !!}
	        @endif
	    </div>
	</div>
@stop
