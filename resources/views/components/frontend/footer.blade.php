<footer class="footer container-fluid bg-white mt-5">
    <div class="container">
        <div class="footer_menu row gap-5">
            <div class="footer_menu_list col-12 col-md-12 col-lg-4">
                <img src="{{ asset(getWebConfiguration()->nav_logo) }}" alt="Logo" width="100" />
                <p>{{ date('Y') }} @ IT TEAM INVFEST</p>
                <b>Follow Us</b>
                <ul class="fot_social">
                    <li class="">
                        <a href="{{ getWebConfiguration()->instagram }}" class="social-icon">
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
                        <a href="{{ 'https://api.whatsapp.com/send/?phone=' . getWebConfiguration()->phone . '&text=' . urlencode('Halo, admin invfest.') }}"
                            class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="footer_menu_list col-12 col-md-12 col-lg-3">
                <h6 class="fw-bold pb-2">Competition</h6>
                <ul class="navbar-nav">
                    @foreach (\App\Models\Competition::all() as $competition)
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
