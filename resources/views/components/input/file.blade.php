<div class="mb-3">
    <label class="form-label" for="{{ $attributes->get('name') }}">{{ $attributes->get('label') }}</label>
    <div id="{{ $attributes->get('name') }}_preview" style="display: none; grid-template-columns: repeat(3, 1fr); gap: 10px;" class="mb-2"></div>
    <input
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($attributes->get('name')) ? ' is-invalid' : '')]) }}
        type="file" id="{{ $attributes->get('name') }}" name="{{ $attributes->get('name') }}">
    @if ($errors->has($attributes->get('name')))
        <div class="invalid-feedback">
            {{ $errors->first($attributes->get('name')) }}
        </div>
    @endif
</div>
