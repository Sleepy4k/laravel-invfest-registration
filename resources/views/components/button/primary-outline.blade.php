<button type="{{ $attributes->get('type', 'button') }}" {{ $attributes->merge(['class' => 'btn btn-outline-primary']) }}>
    {{ $slot }}
</button>
