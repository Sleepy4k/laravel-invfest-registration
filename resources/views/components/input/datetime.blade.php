@php
    $name = $attributes->get('name') ?? '';
    $class = $attributes->merge([
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')
    ])->get('class');
@endphp

<div class="mb-3">
    <label
        class="form-label"
        for="{{ $name }}"
    >
        {{ $attributes->get('label') ?? 'Default Label' }}
    </label>
    <input
        class="{{ $class }}"
        type="datetime-local"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $attributes->get('value') ?? old($name) }}"
    />
    {{-- Display error message if validation fails --}}
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
</div>
