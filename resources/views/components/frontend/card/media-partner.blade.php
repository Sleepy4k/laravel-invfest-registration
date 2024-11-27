<div class="container card-container-custom">
    <div class="d-flex flex-center">
        @foreach ($partners as $partner)
            <div class="card card-custom">
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
