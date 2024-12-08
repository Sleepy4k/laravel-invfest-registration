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
        Email
    </label>
    <input
        class="{{ $class }}"
        type="email"
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
