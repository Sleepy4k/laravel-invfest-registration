<nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top" id="topNav">
    <div class="container">
        <a
            class="navbar-brand mx-auto mx-lg-0 d-flex flex-row justify-content-center align-self-center"
            href="{{ route('frontend.landing') }}"
        >
            <img
                src="{{ asset($appSettings['nav_logo'] ?? '#') }}"
                alt="Logo"
                width="60px"
                height="80px"
                loading="lazy"
            />
            <div class="d-flex flex-column align-self-center justify-self-center mx-3">
                <span class="text-judul font-weight-bold">
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
                            @role('team')
                                {{ auth('web')->user()?->leader?->team?->name ?? '#####' }}
                            @else
                                Admin
                            @endrole
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm p-2" aria-labelledby="navbarDropdownMenuLink">
                            @role('admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>
                                        Dashboard
                                    </a>
                                </li>
                            @else
                                @if (request()->is('team/dashboard'))
                                    <li>
                                        <a class="dropdown-item" href="{{ route('frontend.landing') }}">
                                            <i class="fas fa-home"></i>
                                            Beranda
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('team.dashboard') }}">
                                            <i class="fas fa-tachometer-alt"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                @endif
                            @endrole
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
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
