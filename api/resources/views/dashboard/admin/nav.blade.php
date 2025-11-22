<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" id="search-form">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
        @if (
            !Route::is('dashboard') &&
                !Request::is('Event/*') &&
                !Request::is('EventCategory/*'))
            <div class="search-element">
                <input class="form-control" type="search" name="search" id="search1" placeholder="Search"
                    aria-label="Search" data-width="250">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </div>
        @endif
    </form>
    <ul class="navbar-nav navbar-right">
        @livewire('messages-dropdown')
        

        <li class="dropdown ">
            <a href="/" class="nav-link  nav-link-lg" target="_blank"><i class="fa fa-home"></i></a>
        </li>
        @auth
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">
                        Logged in {{ \Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() }}
                    </div>
                    <a class="dropdown-item has-icon" href="{{ route('auth.edit', Auth::user()->id) }}"><i
                            class="far fa-user"></i> Profile</a>
                    {{-- <a href="{{ route('newsLetter.index') }}" class="dropdown-item has-icon"><i class="fas fa-bolt"></i>
                        News Letter</a> --}}
                    <a href="features-settings.html" class="dropdown-item has-icon"><i class="fas fa-cog"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item has-icon text-danger">
                        <form action="{{ route('user.logout') }}" method="POST" class="mb-0">
                            @csrf
                            <button class="dropdown-item cursor-pointer" style="cursor: pointer" type="submit"><i
                                    class="fas fa-sign-out-alt"></i>
                                Logout</button>
                        </form>
                    </a>
                </div>
            </li>
        @endauth
        @guest
            <li class="dropdown"><a href="{{ route('login') }}" class="nav-link  nav-link-lg nav-link-user"><i
                        class="fa fa-user mr-2"></i> Login</a></li>
        @endguest
    </ul>
</nav>
