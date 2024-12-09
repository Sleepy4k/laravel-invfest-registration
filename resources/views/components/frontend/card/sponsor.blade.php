@foreach ($sponsorsTiers as $tier)
    <div class="container card-container-custom">
        <h2 class="text-white text-center">{{ Str::ucfirst($tier->tier) }}</h2>
        <div class="d-flex flex-center mt-3 items-center">
            @foreach ($tier->sponsorship as $sponsor)
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
@endforeach
