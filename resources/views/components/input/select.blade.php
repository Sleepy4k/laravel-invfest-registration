<div class="mb-3">
    <label class="form-label" for="{{ $attributes->get('name') }}">{{ $attributes->get('label') }}</label>
    <select
        {{ $attributes->merge(['class' => 'form-select' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}
        id="{{ $attributes->get('name') }}" name="{{ $attributes->get('name') }}">
        {{ $slot }}
    </select>
    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">
            {{ $errors->first($attributes->get('name')) }}
        </div>
    @endif
</div>
