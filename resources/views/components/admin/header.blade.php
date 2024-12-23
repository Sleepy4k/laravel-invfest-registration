<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img
                        class="wd-30 ht-30 rounded-circle"
                        src="{{ $profilePicture }}"
                        alt="Profile Picture"
                        loading="lazy"
                    />
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img
                                class="wd-80 ht-80 rounded-circle"
                                src="{{ $profilePicture }}"
                                alt="Profile Picture"
                                loading="lazy"
                            />
                        </div>
                        <div class="text-center">
                            <p class="tx-12 text-muted">
                                {{ auth('web')->user()->email }}
                            </p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ route('frontend.landing') }}">
                                <i class="me-2 icon-md" data-feather="home"></i>
                                Home
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link text-body m-0 p-0">
                                    <i class="me-2 icon-md" data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
