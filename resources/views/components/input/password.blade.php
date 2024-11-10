<div class="mb-3">
    <label for="{{ $attributes->get('name') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <input type="{{ $type ?? 'password' }}" name="{{ $attributes->get('name') }}" value="{{ $attributes->get('value') }}"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}>

    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">
            {{ $errors->first($attributes->get('name')) }}
        </div>
    @endif
</div>
