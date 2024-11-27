<div class="card border-0 shadow-sm">
    <div class="card-header">
        Menu Team
    </div>
    <div class="card-body">
        <ul class="nav nav-side flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('team/dashboard') ? 'active' : '' }}"
                    href="{{ route('team.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
                @if ($paymentStatus)
                    <a class="nav-link mt-2 {{ request()->is('team/karya') ? 'active' : '' }}"
                        href="{{ route('team.work') }}">
                        <i class="fas fa-tasks"></i>
                        Pengumpulan Karya
                    </a>
                @endif
            </li>
        </ul>
    </div>
</div>
