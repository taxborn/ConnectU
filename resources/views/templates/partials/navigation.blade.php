<nav>
    <div class="nav-wrapper">
        <a href="{{ route('home') }}" class="brand-logo">&nbsp;ConnectU</a>
        <ul class="right hide-on-med-and-down">
            @if (Auth::check())
                <li><a href="#!">Search</a></li>
                <li><a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">Profile</a></li>
                <li><a href="{{ route('profile.edit', ['username' => Auth::user()->username]) }}">Edit Profile</a></li>
                @if (Auth::user()->isAdmin(Auth::user()))
                    <li><a href="{{ route('admin.home') }}">Administrator Dashboard</a></li>
                @elseif (Auth::user()->isMod(Auth::user()))
                    <li><a href="{{ route('moderator.home') }}">Moderator Dashboard</a></li>
                @elseif (Auth::user()->isHelper(Auth::user()))
                    <li><a href="{{ route('helper.home') }}">Helper Dashboard</a></li>
                @endif
            @else
                <li><a href="{{ route('auth.signin') }}">Signin</a></li>
                <li><a href="{{ route('auth.signup') }}">Signup</a></li>
            @endif
        </ul>
        <ul id="slide-out" class="side-nav">
            <li><a href="#!">#1 First Sidebar Link</a></li>
            <li><a href="#!">Second Sidebar Link</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </div>
</nav>
