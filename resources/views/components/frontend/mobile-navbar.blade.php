<nav class="nav-mobile d-flex d-md-none d-lg-none">
    @if (request()->is('frontend.landing'))
        <a href="#competition">
            <i class="fas fa-trophy"></i>
            Kompetisi
        </a>
        <a href="#detail">
            <i class="fas fa-info-circle"></i>
            Informasi
        </a>
    @else
        <a href="{{ route('frontend.landing') }}#competition">
            <i class="fas fa-trophy"></i>
            Kompetisi
        </a>
        <a href="{{ route('frontend.landing') }}#detail">
            <i class="fas fa-info-circle"></i>
            Informasi
        </a>
    @endif

    @guest
        <a href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            Masuk
        </a>
    @else
        @role('admin')
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        @else
            @if (request()->is('team/dashboard'))
                <a href="{{ route('frontend.landing') }}">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
            @else
                <a href="{{ route('team.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            @endif
        @endrole

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            Keluar
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
            </form>
        </a>
    @endguest
</nav>
