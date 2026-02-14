@php
    $error = $errors->first($name);
    $selectedValues = (array) old($name, $selected ?? []);
@endphp

<div class="mb-4">
    @if($label)
        <label class="form-label fw-bold text-dark small text-uppercase tracking-wider mb-3">
            {{ $label }}
        </label>
    @endif

    <div class="row g-2">
        @foreach($options as $option)
            <div class="col-md-4 col-sm-6">
                <input 
                    type="checkbox" 
                    class="btn-check shadow-none" 
                    name="{{ $name }}[]" 
                    id="{{ $name }}_{{ $option->id }}" 
                    value="{{ $option->id }}"
                    {{ in_array($option->id, $selectedValues) ? 'checked' : '' }}
                    autocomplete="off"
                >
                <label class="btn btn-outline-light custom-selectable-card w-100 h-100 text-start p-3" for="{{ $name }}_{{ $option->id }}">
                    <div class="d-flex align-items-center">
                        <div class="check-icon me-2"></div>
                        <div>
                            <span class="d-block fw-bold text-dark mb-0">{{ $option->name }}</span>
                            @if(isset($option->description))
                                <small class="text-muted d-block mt-1">{{ $option->description }}</small>
                            @endif
                        </div>
                    </div>
                </label>
            </div>
        @endforeach
    </div>

    @if($error)
        <div class="text-danger small mt-2 d-flex align-items-center">
            <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $error }}
        </div>
    @endif
</div>

<style>
    /* Card Dasar */
    .custom-selectable-card {
        border: 1.5px solid #e9ecef !important;
        background-color: #fff !important;
        transition: all 0.2s ease;
        border-radius: 10px !important;
    }

    /* Hover State */
    .custom-selectable-card:hover {
        border-color: #dee2e6 !important;
        background-color: #f8f9fa !important;
        transform: translateY(-1px);
    }

    /* Checked State (Ketika di klik) */
    .btn-check:checked + .custom-selectable-card {
        border-color: #0d6efd !important;
        background-color: #f0f7ff !important; /* Biru sangat muda */
    }

    /* Variasi Icon Check Custom (Opsional) */
    .check-icon {
        width: 18px;
        height: 18px;
        border: 2px solid #ced4da;
        border-radius: 4px;
        position: relative;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .btn-check:checked + .custom-selectable-card .check-icon {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-check:checked + .custom-selectable-card .check-icon::after {
        content: "✓";
        color: white;
        font-size: 12px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Font & Spacing */
    .tracking-wider { letter-spacing: 0.05em; }
</style>