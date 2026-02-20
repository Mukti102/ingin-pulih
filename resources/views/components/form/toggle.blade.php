@props([
    'name',
    'label' => null,
    'checked' => false,
    'value' => 'on'
])

<div class="form-group">
    @if($label)
        <label class="d-block mb-2 font-weight-bold">{{ $label }}</label>
    @endif
    
    <div class="custom-control custom-switch">
        {{-- Hidden input sebagai fallback agar value 'off' tetap terkirim jika tidak dicentang --}}
        <input type="hidden" name="{{ $name }}" value="off">
        
        <input 
            type="checkbox" 
            name="{{ $name }}" 
            value="{{ $value }}"
            class="custom-control-input" 
            id="toggle-{{ $name }}"
            {{ old($name, $checked) ? 'checked' : '' }}
            {{ $attributes }}
        >
        <label class="custom-control-label font-weight-normal" for="toggle-{{ $name }}">
            <span class="status-text-{{ $name }} text-muted small">
                {{ old($name, $checked) ? 'Aktif' : 'Non-aktif' }}
            </span>
        </label>
    </div>

    @error($name)
        <small class="text-danger d-block mt-1">{{ $message }}</small>
    @enderror
</div>

<style>
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #7c3aed !important;
        border-color: #7c3aed !important;
    }
</style>

<script>
    document.getElementById('toggle-{{ $name }}')?.addEventListener('change', function() {
        const textSpan = document.querySelector('.status-text-{{ $name }}');
        if(textSpan) {
            textSpan.textContent = this.checked ? 'Aktif' : 'Non-aktif';
        }
    });
</script>