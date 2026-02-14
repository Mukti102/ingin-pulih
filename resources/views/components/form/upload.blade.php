@props([
    'label' => null,
    'name',
    'placeholder' => 'Pilih file atau tarik ke sini',
    'required' => false,
    'helper' => 'Format: PDF, JPG, atau PNG (Maks. 2MB)'
])

@php
    $error = $errors->first($name);
@endphp

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="form-label fw-bold text-dark small text-uppercase tracking-wider">
            {{ $label }} @if($required)<span class="text-danger">*</span>@endif
        </label>
    @endif

    <div class="upload-container {{ $error ? 'is-invalid' : '' }}">
        <input 
            type="file" 
            name="{{ $name }}" 
            id="{{ $name }}" 
            class="file-input"
            {{ $required ? 'required' : '' }}
            onchange="updateFileName(this)"
            {{ $attributes }}
        >
        
        <div class="upload-box d-flex align-items-center p-3">
            <div class="upload-icon-wrapper me-3">
                <i class="bi bi-cloud-arrow-up-fill text-primary fs-4"></i>
            </div>
            <div class="flex-grow-1">
                <span class="d-block fw-semibold text-dark file-name-label">{{ $placeholder }}</span>
                <small class="text-muted small-helper">{{ $helper }}</small>
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                Browse
            </button>
        </div>
    </div>

    @if($error)
        <div class="text-danger small mt-2">
            <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $error }}
        </div>
    @endif
</div>

<style>
    .upload-container {
        position: relative;
        border: 2px dashed #dee2e6;
        border-radius: 12px;
        background-color: #fff;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .upload-container:hover {
        border-color: #0d6efd;
        background-color: #f8f9fa;
    }

    .upload-container.is-invalid {
        border-color: #dc3545;
        background-color: #fff8f8;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .upload-icon-wrapper {
        width: 45px;
        height: 45px;
        background-color: #f0f7ff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload-container:focus-within {
        ring: 3px rgba(13, 110, 253, 0.15);
        border-color: #0d6efd;
    }
</style>

<script>
    function updateFileName(input) {
        const fileName = input.files[0]?.name || "{{ $placeholder }}";
        const container = input.closest('.upload-container');
        container.querySelector('.file-name-label').textContent = fileName;
        container.querySelector('.small-helper').textContent = "File terpilih";
        container.style.borderStyle = "solid";
        container.style.borderColor = "#198754"; // Warna hijau sukses
    }
</script>