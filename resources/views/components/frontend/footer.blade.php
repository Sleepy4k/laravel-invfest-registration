<footer class="footer container-fluid bg-white mt-5">
    <div class="container">
        <div class="footer_menu row gap-5">
            <div class="footer_menu_list col-12 col-md-12 col-lg-4">
                <img src="{{ isset($appSettings['nav_logo']) ? asset($appSettings['nav_logo']) : '#' }}" alt="Logo" width="75" height="75" />
                <p class="mt-3">{{ date('Y') }} @ IT TEAM INVFEST</p>
                <b>Follow Us</b>
                <ul class="fot_social">
                    <li class="">
                        <a href="{{ $appSettings['instagram'] }}" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer_menu_list col-12 col-md-12 col-lg-3">
                <h6 class="fw-bold pb-2">Navigation</h6>
                <ul class="navbar-nav">
                    <li>
                        <a href="{{ route('frontend.landing') }}" class="nav-link">Home</a>
                    </li>
                    <li>
                        <a href="{{ 'https://api.whatsapp.com/send/?phone=' . $appSettings['phone'] . '&text=' . urlencode('Halo, admin invfest.') }}"
                            class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="footer_menu_list col-12 col-md-12 col-lg-3">
                <h6 class="fw-bold pb-2">Competition</h6>
                <ul class="navbar-nav">
                    @foreach ($latestCompetition as $competition)
                        <li>
                            <a href="{{ route('frontend.competition.show', $competition->slug) }}"
                                class="nav-link">{{ $competition->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
