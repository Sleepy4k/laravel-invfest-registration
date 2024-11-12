<nav class="navbar  navbar-expand-lg navbar-light shadow-sm " id="topNav">
    <div class="container">

        <a class="navbar-brand mx-auto mx-lg-0
            d-flex flex-row justify-content-center align-self-center"
            href="{{ route('frontend.landing') }}">
            <img src="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" alt="Logo" width="60px" height="80px" />
            <div class="d-flex flex-column align-self-center justify-self-center mx-3">
                <span class="text-blue font-weight-bold">
                    {{ $appSettings['title'] }}
                </span>
                <small class="text-slogan">
                    {{ $appSettings['slogan'] }}
                </small>
            </div>
        </a>

        <div class="d-none d-lg-block" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                @guest
                    <a class="btn btn-primary btn-rounded me-3" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                    <a class="btn btn-primary btn-rounded" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i>
                        Register
                    </a>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            {{ auth('web')->user()->leader->first()->team->first()->name ?? 'Admin' }}
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm p-2" aria-labelledby="navbarDropdownMenuLink">
                            @hasrole('admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Dashboard
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="{{ route('team.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endhasrole
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-light navbar-expand p-0 d-lg-none d-xl-none fixed-bottom top-shadow bg-white" id="bottomNav">
    <ul class="navbar-nav nav-justified w-100">

    </ul>
</nav>
