<div class="mb-3">
    <label for="{{ $attributes->get('name') }}" class="form-label">{{ $attributes->get('label') }}</label>

    <textarea name="{{ $attributes->get('name') }}"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}
        rows="5">{{ $attributes->get('value') }}</textarea>

    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">
            {{ $errors->first($attributes->get('name')) }}
        </div>
    @endif
</div>
