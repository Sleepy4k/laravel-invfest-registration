<div class="container card-container-custom">
    <div class="d-flex flex-center">
        @foreach ($partners as $partner)
            <div
                data-aos="fade-up"
                data-aos-delay="{{ ($loop->iteration ^ 2) * 50 }}"
                class="card card-custom"
            >
                <img
                    src="{{ asset($partner->logo ?? '#') }}"
                    class="card-img card-img-custom"
                    alt="{{ $partner->name }}"
                    loading="lazy"
                />
            </div>
        @endforeach
    </div>
</div>
