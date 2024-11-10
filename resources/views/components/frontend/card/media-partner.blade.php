<div class="container my-5">
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
        @foreach ($partners as $partner)
            <div class="card border-0">
                <img src="{{ asset($partner->logo) }}" class="card-img p-3" alt="{{ $partner->name }}">
            </div>
        @endforeach
    </div>
</div>
