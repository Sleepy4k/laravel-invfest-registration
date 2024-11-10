<button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->merge(['class' => 'btn btn-primary']) }}
    id="{{ $attributes->get('id') }}">
    {{ $slot }}
</button>
