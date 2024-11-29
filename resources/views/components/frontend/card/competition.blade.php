<div class="row justify-content-center">
    @foreach ($competitions as $competition)
        <div
            data-aos="fade-up"
            data-aos-delay="{{ ($loop->iteration ^ 2) * 50 }}"
            class="col-12 col-md-6 col-lg-4 mt-4"
        >
            <div class="card card-competition">
                <div class="position-relative">
                    <img
                        src="{{ asset($competition->poster ?? '#') }}"
                        class="card-img-top p-3"
                        alt="{{ $competition->name }}"
                        loading="lazy"
                    />
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-secondary badge-competition">
                            {{ $competition->level->display_as }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h5
                        data-aos="fade-right"
                        data-aos-delay="{{ ($loop->iteration ^ 2) * 75 }}"
                        class="card-title"
                    >
                        {{ $competition->name }}
                    </h5>
                    <p
                        data-aos="fade-right"
                        data-aos-delay="{{ ($loop->iteration ^ 2) * 100 }}"
                        class="card-text"
                    >
                        Biaya Pendaftaran: {{ $competition->registration_fee_rupiah }}
                    </p>
                    <a
                        data-aos="fade-right"
                        data-aos-delay="{{ ($loop->iteration ^ 2) * 125 }}"
                        href="{{ route('frontend.competition.show', $competition->slug) }}"
                        class="btn btn-block card-button"
                    >
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
