@props(['id' => 'date-range-picker', 'value' => 'Pilih Tanggal'])

<div class="relative">
    <button id="{{ $id }}"
        class="flex items-center gap-4 px-5 py-4 bg-brand-700 text-white rounded-xl  active:scale-95 w-max group border border-brand-800">
        <div
            class="flex-shrink-0 rounded-xl flex items-center justify-center text-brand-300 group-hover:text-white transition-colors">
            <i class="fas fa-calendar-alt text-2xl"></i>
        </div>
        <div class="flex flex-col items-start leading-tight text-left">
            <span class="text-[10px] font-black uppercase tracking-widest text-brand-300">Rentang Waktu</span>
            <span id="selected-date-text" class="text-sm font-bold">{{ $value }}</span>
        </div>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#date-range-picker", {
            mode: "range",
            dateFormat: "d M Y",
            minDate: "today",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    // 1. Update Teks Tampilan (User Friendly)
                    const dateText = document.getElementById('selected-date-text');
                    
                    const startDate = instance.formatDate(selectedDates[0], "Y-m-d");
                    const endDate = instance.formatDate(selectedDates[1], "Y-m-d");
                    const finalRange = startDate + " to " + endDate;
                    dateText.innerText = dateStr.replace(" to ", " - ");
                    
                    @this.set('selectedDate', finalRange);
                }
            },
            // Menyesuaikan tampilan agar elegan
            locale: {
                rangeSeparator: " - "
            }
        });
    });
</script>
