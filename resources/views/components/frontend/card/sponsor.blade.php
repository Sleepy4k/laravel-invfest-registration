<div class="container my-5 ">
    <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
        @foreach ($sponsors as $sponsor)
            <div class="card border-0">
                <img src="{{ asset($sponsor->logo) }}" class="card-img p-3" alt="{{ $sponsor->name }}">
            </div>
        @endforeach
    </div>
</div>
