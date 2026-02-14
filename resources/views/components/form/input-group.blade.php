@props([
    'label' => null,
    'name',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'value' => null,
    'suffix' => null,
    'prefix' => null
])

@php
    // Menangkap error dari session Laravel
    $hasError = $errors->has($name);
    $errorMessage = $errors->first($name);
    $inputValue = old($name, $value);
@endphp

<div class="form-group mb-3">
    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}" class="form-label fw-bold small text-secondary">
            {{ $label }} @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif

    {{-- Input Group Container --}}
    <div class="input-group @if($hasError) is-invalid @endif">
        
        {{-- Prefix (Awalan) --}}
        @if($prefix)
            <span class="input-group-text bg-white border-end-0 {{ $hasError ? 'border-danger' : '' }}">
                {!! $prefix !!}
            </span>
        @endif

        {{-- Input Field --}}
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $name }}"
            value="{{ $inputValue }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'form-control shadow-none ' . 
                           ($hasError ? 'is-invalid ' : '') . 
                           ($prefix ? 'border-start-0 ' : '') . 
                           ($suffix ? 'border-end-0 ' : '')
            ]) }}
        />

        {{-- Suffix (Akhiran) --}}
        @if($suffix)
            <span class="input-group-text fw-medium {{ $hasError ? 'border-danger text-danger' : 'text-muted' }} {{ $prefix ? '' : 'border-start-0' }}">
                {{ $suffix }}
            </span>
        @endif
    </div>

    {{-- Error Message --}}
    @if($hasError)
        <div class="invalid-feedback d-block mt-1" style="font-size: 0.85rem;">
            <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $errorMessage }}
        </div>
    @endif
</div>

<style>
    /* Membuat border input group menyatu saat focus */
    .input-group:focus-within .input-group-text {
        border-color: #86b7fe;
        color: #0d6efd !important;
    }
    
    /* Memastikan border merah saat error tetap sinkron di group text */
    .input-group.is-invalid .input-group-text {
        border-color: #dc3545;
    }
</style>