<div class="card">
    <div class="card-body">
        <h6 class="card-title">
            {{ $attributes->get('title') }}
        </h6>

        {{ $slot }}
    </div>

    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>
