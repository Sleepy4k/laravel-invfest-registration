<div class="card card-hero" data-aos="fade-down">
    <div class="card-body text-white">
        <h2 class="text-center">
            {{ $appSettings['title'] }}
        </h2>
        <div class="d-flex justify-content-between align-items-center">
            <div class="information">
                <h2 id="hero-heading">{{ $appSettings['heading'] }}</h2>
                <div class="d-flex gap-3 mt-4">
                    <a href="#detail" class="btn btn-sm btn-rounded text-white btn-secondary">
                        <i class="fas fa-arrow-down"></i>
                        Detail
                    </a>
                    <a href="{{ route('register') }}"
                        class="btn btn-sm btn-rounded border border-1 border-white text-white">
                        <i class="fas fa-user-plus"></i>
                        Daftar
                    </a>
                </div>
            </div>
            <img
                src="{{ asset($appSettings['mascot'] ?? '#') }}"
                alt="mascot"
                class="mascot-image"
                loading="lazy"
            />
        </div>
    </div>
</div>
