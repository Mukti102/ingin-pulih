@props([
    'label' => null,
    'name',
    'value' => ''
])

<div class="mb-4">
    @if($label)
        <label for="{{ $name }}" class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-1">
            {{ $label }}
        </label>
    @endif

    <select 
        name="{{ $name }}" 
        id="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2.5 rounded-lg border ' . 
                       ($errors->has($name) ? 'border-red-400 bg-red-50' : 'border-gray-200 bg-white') . 
                       ' focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all outline-none text-sm appearance-none cursor-pointer'
        ]) }}
    >
        {{ $slot }}
    </select>

    @error($name)
        <p class="text-red-500 text-[10px] mt-1 font-semibold flex items-center">
            <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
        </p>
    @enderror
</div>