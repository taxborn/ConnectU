<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
            <a class="navbar-brand" href="{{ route('home') }}">ConnectU</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if (Auth::check())
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('home') }}">Timeline</a></li>
                </ul>
                <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                    <div class="form-group">
                        <input type="text" name="query" class="form-control" placeholder="Find people">
                    </div>
                    &nbsp;
                    &nbsp;
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle-nav" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img style="border-radius: 5px;" src="{{ Auth::user()->getAvatarUrl(30) }}" alt="{{ Auth::user()->getNameOrUsername() }}">&nbsp;&nbsp;{{ Auth::user()->getNameOrUsername() }}&nbsp;&nbsp;<span class="caret"></span></a></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">Profile</a></li>
                             <li><a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Update Profile</a></li>
                            @if (Auth::user()->isAdmin(Auth::user()))
                                <li><a href="{{ route('admin.home') }}">Admin Dashboard</a></li>
                            @elseif (Auth::user()->isMod(Auth::user()))
                                <li><a href="{{ route('moderator.home') }}">Moderator Dashboard</a></li>
                            @elseif (Auth::user()->isHelper(Auth::user()))
                                <li><a href="{{ route('helper.home') }}">Helper Dashboard</a></li>
                            @endif
                            <li><a href="{{ route('friends.index') }}">Friends
                            @if (Auth::user()->friendRequests()->count())
                                <span class="label label-success pull-right" style="margin-top: 4px">{{ Auth::user()->friendRequests()->count() }}</span>
                            @endif
                            </a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('auth.signout') }}">Signout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                    <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
