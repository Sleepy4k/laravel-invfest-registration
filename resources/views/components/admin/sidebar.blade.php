<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}">
            <img src="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" class="sidebar-brand" width="40" loading="lazy">
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
                <li class="nav-item {{ request()->is('admin/competition*') ? ' active' : '' }}">
                    <a href="{{ route('admin.competition.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="award"></i>
                        <span class="link-title">Manajemen Kompetisi</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/timeline*') ? ' active' : '' }}">
                    <a href="{{ route('admin.timeline.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="clock"></i>
                        <span class="link-title">Timeline</span>
                    </a>
                </li>
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
            @endhasrole
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted mb-2">Sidebar:</h6>
        <div class="mb-3 pb-3 border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
    </div>
</nav>
