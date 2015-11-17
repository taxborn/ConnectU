<div class="navbar-fixed">
    <nav class="indigo">
        <div class="nav-wrapper">
            <a href="{{ route('home') }}" class="brand-logo">&nbsp;ConnectU</a>
            <ul class="right hide-on-med-and-down">
                @if (Auth::check())
                    <li><a href="#!">Search</a></li>
                    <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">Profile</a></li>
                    <li><a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Edit Profile</a></li>
                    @if (Auth::user()->hasPosition('admin'))
                        <li><a href="{{ route('admin.home') }}">Administrator Dashboard</a></li>
                    @elseif (Auth::user()->hasPosition('admin'))
                        <li><a href="{{ route('moderator.home') }}">Moderator Dashboard</a></li>
                    @elseif (Auth::user()->hasPosition('helper'))
                        <li><a href="{{ route('helper.home') }}">Helper Dashboard</a></li>
                    @endif
                    <li><a href="{{ route('auth.signout') }}">Sign out</a></li>
                @else
                    <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                    <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                @endif
            </ul>
            <ul id="slide-out" class="side-nav">
                @if (Auth::check())
                    <li><a href="#!">Search</a></li>
                    <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">Profile</a></li>
                    <li><a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Edit Profile</a></li>
                    @if (Auth::user()->hasPosition('admin'))
                        <li><a href="{{ route('admin.home') }}">Administrator Dashboard</a></li>
                    @elseif (Auth::user()->hasPosition('mod'))
                        <li><a href="{{ route('moderator.home') }}">Moderator Dashboard</a></li>
                    @elseif (Auth::user()->hasPosition('helper'))
                        <li><a href="{{ route('helper.home') }}">Helper Dashboard</a></li>
                    @endif
                    <li><a href="{{ route('auth.signout') }}">Sign out</a></li>
                @else
                    <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                    <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                @endif
            </ul>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>
</div>
