<div class="container my-5">
    <div class="d-flex flex-wrap justify-content-center align-items-center" style="gap: 20px;">
        @foreach ($partners as $partner)
            <div class="card border-0" style="width: 200px; height: 200px; overflow: hidden; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transition: transform 0.2s;">
                <img src="{{ isset($partner->logo) ? asset($partner->logo) : '#' }}" class="card-img" alt="{{ $partner->name }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
            </div>
        @endforeach
    </div>
</div>