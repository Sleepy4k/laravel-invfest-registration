<x-layouts.frontend title="{{ $competition->name }}" description="{{ $competition->description }}">
    <div class="container mt-5 d-flex justify-space-between gap-5 flex-column flex-md-row">
        <img
            src="{{ $competition->poster ?? '#' }}"
            class="img-fluid rounded-2"
            alt="{{ $competition->name }}"
            style="width: 100%"
            loading="lazy"
        />
        <div class="information">
            <h1 class="text-primary">{{ $competition?->name }}</h1>
            <p class="text-muted m-0">Biaya Pendaftaran: {{ $competition?->registration_fee_rupiah }}</p>
            <p class="text-muted m-0">Level: {{ $competition?->level?->display_as }}</p>
            <a href="{{ route('register') }}" class="btn btn-primary mt-3 w-100">
                Daftar Kompetisi
            </a>
            <a href="{{ $competition->poster ?? '#' }}" class="btn btn-secondary mt-3 w-100" target="_blank">
                Guidebook
            </a>
            <hr>
            {!! $competition?->description !!}
        </div>
    </div>
</x-layouts.frontend>
