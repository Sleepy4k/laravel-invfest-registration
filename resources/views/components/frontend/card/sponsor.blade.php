<div class="container card-container-custom">
    <div class="d-flex flex-center">
        @foreach ($sponsors as $sponsor)
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
