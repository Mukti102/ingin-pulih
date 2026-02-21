 <div
     class="relative bg-gray-50 border border-gray-300 shadow-sm p-2 rounded-[1rem] hover:shadow-2xl hover:shadow-brand-100/40 transition-all duration-500 group">
     <div class="flex flex-col md:flex-row md:items-center gap-6 p-4">
         <div class="relative md:mx-0 mx-auto flex-shrink-0">
             <div
                 class="absolute inset-0 bg-brand-200 rounded-[2rem] rotate-3 group-hover:rotate-6 transition-transform">
             </div>
             @if ($psikolog->user->avatar)
                 <img src="{{ Storage::url($psikolog->user->avatar) }}" alt="Avatar"
                     class="relative w-32 h-32 rounded-[2rem] object-cover border-2 border-white shadow-sm">
             @else
                 <img src="https://ui-avatars.com/api/?name={{ urlencode($psikolog->fullname) }}&background=fff&color=7c3aed&size=200"
                     class="relative w-32 h-32 rounded-[2rem] object-cover border-2 border-white shadow-sm">
             @endif
         </div>

         <div class="flex-1">
             <div
                 class="inline-block px-4 py-1 border border-orange-200/50 bg-orange-50 text-orange-600 text-[10px] font-black rounded-full mb-2">
                 {{ $psikolog->jenisPsikolog->name }}
             </div>
             <h3 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-brand-600 transition-colors">
                 {{ $psikolog->fullname }}
             </h3>

             <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 mt-3">
                 <span class="flex items-center gap-1"><i class="fas fa-briefcase text-brand-300"></i>
                     {{ $psikolog->experience_years }} Tahun</span>
                 @php
                     $activeReviews = $psikolog->reviews()->where('published', true)->latest()->get();

                     $averageRating = $activeReviews->avg('rating') ?? 0;
                     $totalReviews = $activeReviews->count();

                 @endphp

                 <span class="flex items-center gap-1"><i class="fas fa-comment-dots text-brand-300"></i>
                     {{ $psikolog->booking->count() }}+ Sesi</span>
                 <span class="flex items-center gap-1 text-yellow-500 font-bold"><i class="fas fa-star"></i>
                     {{ number_format($averageRating, 1) }} ({{ $totalReviews }})</span>
             </div>

             <div class="mt-4 flex items-center gap-2 text-sm text-gray-600">
                 <i class="far fa-clock text-brand-300"></i>
                 <span>Jadwal Tersedia:
                     <span class="font-bold text-gray-900">
                         @php
                             $displaySchedule = 'Pilih tanggal/hari';

                             // Tentukan hari target (lowercase)
                             $targetDay = null;
                             if ($this->day) {
                                 $targetDay = $this->day;
                             } elseif ($this->selectedDate && !str_contains($this->selectedDate, ' to ')) {
                                 $targetDay = strtolower(\Carbon\Carbon::parse($this->selectedDate)->format('l'));
                             }

                             if ($targetDay) {
                                 // Cari jadwal yang cocok dari koleksi yang sudah di-load
                                 $schedule = $psikolog->weeklySchedules
                                     ->where('day_of_week', $targetDay)
                                     ->where('is_active', true)
                                     ->first();

                                 if ($schedule) {
                                     $displaySchedule =
                                         \Carbon\Carbon::parse($schedule->start_time)->format('H:i') .
                                         ' - ' .
                                         \Carbon\Carbon::parse($schedule->end_time)->format('H:i') .
                                         ' WIB';
                                 } else {
                                     $displaySchedule = 'Tidak ada jadwal';
                                 }
                             } elseif ($this->selectedDate && str_contains($this->selectedDate, ' to ')) {
                                 $displaySchedule = 'Lihat detail (Range Tanggal)';
                             } else {
                                 // Default: Tampilkan jadwal hari ini atau hari terdekat jika tidak ada filter
                                 $today = strtolower(now()->format('l'));
                                 $todaySchedule = $psikolog->weeklySchedules
                                     ->where('day_of_week', $today)
                                     ->where('is_active', true)
                                     ->first();

                                 if ($todaySchedule) {
                                     $displaySchedule =
                                         'Hari ini: ' .
                                         \Carbon\Carbon::parse($todaySchedule->start_time)->format('H:i') .
                                         ' WIB';
                                 } else {
                                     $displaySchedule = 'Cek detail profil';
                                 }
                             }
                         @endphp
                         {{ $displaySchedule }}
                     </span>
                 </span>
             </div>
         </div>

         <div class="md:border-l border-gray-200 md:pl-8 flex flex-col items-center justify-center">
             <a href="{{ route('detail.psikolog', encrypt($psikolog->id)) }}"
                 class="w-full md:w-auto px-7 py-2 bg-orange-500 text-white text-sm font-bold rounded-xl md:rounded-2xl text-center hover:bg-brand-600 transition-all shadow-sm shadow-gray-200">
                 Booking Sesi
             </a>
         </div>
     </div>
 </div>
