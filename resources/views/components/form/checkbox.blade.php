@props([
    'name', 
    'label' => null, 
    'checked' => false, 
    'value' => 1
])

<div {{ $attributes->merge(['class' => 'form-check form-switch custom-switch']) }}>
    <input 
        class="form-check-input shadow-none" 
        type="checkbox" 
        role="switch"
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        style="cursor: pointer;"
    >
    @if($label)
        <label class="form-check-label fw-bold text-secondary" for="{{ $name }}" style="cursor: pointer; font-size: 0.85rem;">
            {{ $label }}
        </label>
    @endif
</div>

<style>
    /* Custom warna Violet untuk Bootstrap Switch */
    .custom-switch .form-check-input:checked {
        background-color: #7c3aed !important;
        border-color: #7c3aed !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e") !important;
    }
    
    .custom-switch .form-check-input:focus {
        border-color: #7c3aed;
        box-shadow: 0 0 0 0.25rem rgba(124, 58, 237, 0.25) !important;
    }

    .custom-switch .form-check-input {
        width: 2.5em; /* Lebih lebar untuk gaya switch */
        height: 1.25em;
        cursor: pointer;
        transition: background-position .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
    }
</style>