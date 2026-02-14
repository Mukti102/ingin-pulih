@php
    $error = $errors->first($name);
@endphp

    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-control ' . ($error ? 'is-invalid' : ''),
        ]) }}>

    @if ($error)
        <div class="invalid-feedback">
            {{ $error }}
        </div>
    @endif
