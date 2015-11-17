<div class="media">
    <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username]) }}">
        <img class="media-object" style="border-radius: 5px;" alt="{{ $user->getNameOrUsername() }}" src="{{ $user->getAvatarUrl() }}">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getNameOrUsername() }}
		</a>
		</h4>
		@if ($user->hasPosition('admin'))
			<span class="label label-danger" style="position: absolute;">Administrator</span>
		@elseif ($user->hasPosition('mod'))
			<span class="label label-info" style="position: absolute;">Moderator</span>
		@elseif ($user->hasPosition('helper'))
			<span class="label label-success" style="position: absolute;">Helper</span>
		@endif
    </div>
</div>
