@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'required' => false,
    'placeholder' => '-- Pilih --',
])

<div class="mb-3 {{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $name }}" class="form-label fw-bold">
            {{ $label }} {!! $required ? '<span class="text-danger">*</span>' : '' !!}
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-select ' . ($errors->has($name) ? 'is-invalid' : '')]) }}>
        @if ($placeholder)
            <option value="" disabled {{ is_null(old($name, $selected)) ? 'selected' : '' }}>
                {{ $placeholder }}
            </option>
        @endif

        @foreach ($options as $value => $labelOption)
            <option value="{{ $labelOption->id }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $labelOption->name }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
