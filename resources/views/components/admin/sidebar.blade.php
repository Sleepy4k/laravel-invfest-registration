<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('frontend.landing') }}">
            <img src="{{ $appSettings['nav_logo'] ?? '#' }}" class="sidebar-brand" width="40" loading="lazy">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->is('admin/dashboard') ? ' active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Peserta</li>
            <li class="nav-item {{ request()->is('admin/team*') ? ' active' : '' }}">
                <a href="{{ route('admin.team.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Tim Peserta</span>
                </a>
            </li>

            @hasrole('admin')
                <li class="nav-item {{ request()->is('admin/work*') ? ' active' : '' }}">
                    <a href="{{ route('admin.work.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="code"></i>
                        <span class="link-title">Karya Peserta</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Managemen Kompetisi</li>
                <li class="nav-item {{ request()->is('admin/competition*') ? ' active' : '' }}">
                    <a href="{{ route('admin.competition.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title">Kompetisi</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/timeline*') ? ' active' : '' }}">
                    <a href="{{ route('admin.timeline.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="clock"></i>
                        <span class="link-title">Timeline</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Partnership</li>
                <li class="nav-item {{ request()->is('admin/sponsor*') ? ' active' : '' }}">
                    <a href="{{ route('admin.sponsor.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Sponsorship</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/media-partner*') ? ' active' : '' }}">
                    <a href="{{ route('admin.media-partner.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="share-2"></i>
                        <span class="link-title">Media Partner</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Setting</li>
                <li class="nav-item {{ request()->is('admin/payment-method*') ? ' active' : '' }}">
                    <a href="{{ route('admin.payment-method.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Metode Pembayaran</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/website-configuration') ? ' active' : '' }}">
                    <a href="{{ route('admin.website-configuration.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Konfigurasi Web</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Log</li>
                <li class="nav-item {{ request()->is('admin/log/auth*') ? ' active' : '' }}">
                    <a href="{{ route('admin.auth.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="key"></i>
                        <span class="link-title">Auth</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/log/model*') ? ' active' : '' }}">
                    <a href="{{ route('admin.model.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="database"></i>
                        <span class="link-title">Model</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/log/system*') ? ' active' : '' }}">
                    <a href="{{ route('admin.system.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="cpu"></i>
                        <span class="link-title">System</span>
                    </a>
                </li>
            @endhasrole
        </ul>
    </div>
</nav>
