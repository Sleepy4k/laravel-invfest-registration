@foreach ($sponsorsTiers as $tier)
    @if (count($tier->sponsorships) === 0)
        @continue
    @else
        <div class="container card-container-custom">
            <h2 class="text-white text-center">{{ Str::ucfirst($tier->tier) }}</h2>
            <div class="d-flex flex-center mt-3 items-center">
                @foreach ($tier->sponsorships as $sponsor)
                    <div
                        data-aos="fade-up"
                        data-aos-delay="{{ ($loop->iteration ^ 2) * 50 }}"
                        class="card card-custom"
                    >
                        <img
                            src="{{ $sponsor->logo ?? '#' }}"
                            class="card-img card-img-custom"
                            alt="{{ $sponsor->name }}"
                            loading="lazy"
                        />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endforeach
