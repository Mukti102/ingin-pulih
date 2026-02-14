@props(['name', 'label' => null, 'value' => null, 'rows' => 3, 'required' => false, 'placeholder' => ''])

<div class="mb-3 {{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $name }}" class="form-label fw-bold">
            {{ $label }} {!! $required ? '<span class="text-danger">*</span>' : '' !!}
        </label>
    @endif

    <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
