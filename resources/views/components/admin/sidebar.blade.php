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
            <li class="nav-item {{ request()->is('dashboard/dashboard') ? ' active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Peserta</li>
            <li class="nav-item {{ request()->is('dashboard/team*') ? ' active' : '' }}">
                <a href="{{ route('admin.team.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Tim Peserta</span>
                </a>
            </li>

            @hasrole('admin')
                <li class="nav-item {{ request()->is('dashboard/work*') ? ' active' : '' }}">
                    <a href="{{ route('admin.work.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="code"></i>
                        <span class="link-title">Karya Peserta</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Managemen Kompetisi</li>
                <li class="nav-item {{ request()->is('dashboard/competition*') ? ' active' : '' }}">
                    <a href="{{ route('admin.competition.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title">Kompetisi</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/level*') ? ' active' : '' }}">
                    <a href="{{ route('admin.level.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="chevrons-up"></i>
                        <span class="link-title">Level Kompetisi</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/timeline*') ? ' active' : '' }}">
                    <a href="{{ route('admin.timeline.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="clock"></i>
                        <span class="link-title">Timeline</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Partnership</li>
                <li class="nav-item {{ request()->is('dashboard/sponsor*') ? ' active' : '' }}">
                    <a href="{{ route('admin.sponsor.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Sponsorship</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/tier*') ? ' active' : '' }}">
                    <a href="{{ route('admin.tier.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="chevrons-up"></i>
                        <span class="link-title">Tingkat Sponsor</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/media-partner*') ? ' active' : '' }}">
                    <a href="{{ route('admin.media-partner.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="share-2"></i>
                        <span class="link-title">Media Partner</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Pengguna</li>
                <li class="nav-item {{ request()->is('dashboard/user*') ? ' active' : '' }}">
                    <a href="{{ route('admin.user') }}" class="nav-link">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title">User Data</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/otp*') ? ' active' : '' }}">
                    <a href="{{ route('admin.otp') }}" class="nav-link">
                        <i class="link-icon" data-feather="hash"></i>
                        <span class="link-title">User OTP</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Setting</li>
                <li class="nav-item {{ request()->is('dashboard/payment-method*') ? ' active' : '' }}">
                    <a href="{{ route('admin.payment-method.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Metode Pembayaran</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/website-configuration*') ? ' active' : '' }}">
                    <a href="{{ route('admin.website-configuration.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Konfigurasi Web</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/request-settings*') ? ' active' : '' }}">
                    <a href="{{ route('admin.request-settings.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Konfigurasi Permintaan</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Tool</li>
                <li class="nav-item {{ request()->is('dashboard/tools/clear-cache*') ? ' active' : '' }}">
                    <a href="{{ route('admin.tools.clear-cache.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Clear Cache</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/tools/optimize*') ? ' active' : '' }}">
                    <a href="{{ route('admin.tools.optimize.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Optimize Cache</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/tools/sitemap*') ? ' active' : '' }}">
                    <a href="{{ route('admin.tools.sitemap.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Generate Sitemap</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/tools/database*') ? ' active' : '' }}">
                    <a href="{{ route('admin.tools.database.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="credit-card"></i>
                        <span class="link-title">Database Backup</span>
                    </a>
                </li>

                <li class="nav-item nav-category">Log</li>
                <li class="nav-item {{ request()->is('dashboard/log/auth*') ? ' active' : '' }}">
                    <a href="{{ route('admin.auth.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="key"></i>
                        <span class="link-title">Auth</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/log/model*') ? ' active' : '' }}">
                    <a href="{{ route('admin.model.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="database"></i>
                        <span class="link-title">Model</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('dashboard/log/system*') ? ' active' : '' }}">
                    <a href="{{ route('admin.system.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="cpu"></i>
                        <span class="link-title">System</span>
                    </a>
                </li>
            @endhasrole
        </ul>
    </div>
</nav>
