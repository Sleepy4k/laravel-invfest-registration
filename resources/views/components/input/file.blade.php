<div class="mb-3">
    <label class="form-label" for="{{ $attributes->get('name') }}">{{ $attributes->get('label') }}</label>
    <input
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}
        type="file" id="{{ $attributes->get('name') }}" name="{{ $attributes->get('name') }}">
    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">
            {{ $errors->first($attributes->get('name')) }}
        </div>
    @endif
</div>
