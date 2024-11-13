<div class="row justify-content-center">
    @foreach ($competitions as $competition)
        <div class="col-12 col-md-6 col-lg-4 mt-4">
            <div class="card card-competition">
                <div class="position-relative">
                    <img src="{{ isset($competition->poster) ? asset($competition->poster) : '#' }}"
                        class="card-img-top p-3" alt="{{ $competition->name }}">
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-secondary badge-competition">
                            {{ $competition->level->level }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $competition->name }}</h5>
                    <p class="card-text">Biaya Pendaftaran: {{ $competition->registration_fee_rupiah }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('frontend.competition.show', $competition->slug) }}"
                        class="btn btn-secondary btn-block">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
