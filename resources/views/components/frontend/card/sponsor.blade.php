<div class="container card-container-custom">
    <div class="d-flex flex-center">
        @foreach ($sponsors as $sponsor)
            <div class="card card-custom">
                <img
                    src="{{ asset($sponsor->logo ?? '#') }}"
                    class="card-img card-img-custom"
                    alt="{{ $sponsor->name }}"
                    loading="lazy"
                />
            </div>
        @endforeach
    </div>
</div>
