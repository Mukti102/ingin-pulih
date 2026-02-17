<x-guest-layout>
    <div class="bg-white min-h-screen">
        @livewire('psychologist-list')
    </div>
</x-guest-layout>

<style>
    /* Menghilangkan scrollbar tapi tetap bisa di-scroll */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
