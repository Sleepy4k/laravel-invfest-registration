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
    <div id="{{ $attributes->get('name') }}_preview" style="display: none; grid-template-columns: repeat(3, 1fr); gap: 10px;" class="mb-2"></div>
    <input
        class="{{ $class }}"
        type="file"
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
