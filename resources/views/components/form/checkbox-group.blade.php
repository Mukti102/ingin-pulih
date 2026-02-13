@php
    $error = $errors->first($name);
    $selectedValues = old($name, $selected ?? []);
@endphp

<div class="mb-3 col-md-6 col-12">

    @if($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <div class="{{ $error ? 'is-invalid' : '' }}">

        @foreach($options as $option)
            <div class="form-check">
                <input 
                    class="form-check-input"
                    type="checkbox"
                    name="{{ $name }}[]"
                    value="{{ $option->id }}"
                    id="{{ $name }}_{{ $option->id }}"
                    {{ in_array($option->id, $selectedValues) ? 'checked' : '' }}
                >

                <label class="form-check-label" for="{{ $name }}_{{ $option->id }}">
                    {{ $option->name }}
                </label>
            </div>
        @endforeach

    </div>

    @if($error)
        <div class="invalid-feedback d-block">
            {{ $error }}
        </div>
    @endif

</div>
