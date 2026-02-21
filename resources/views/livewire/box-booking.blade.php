 <section class="bg-brand-900 md:rounded-[2.5rem] rounded-[1rem] p-6 md:p-8 text-white shadow-xl"
     x-on:scroll-to-alert.window="document.getElementById('alert-error').scrollIntoView({ behavior: 'smooth' })">
     @if (session()->has('error'))
         <div class="mb-4 p-4 bg-red-500/20 border border-red-500 text-red-200 rounded-2xl text-sm">
             {{ session('error') }}
         </div>
     @endif



     <h2 class="text-xl font-bold mb-6">Atur Jadwal Sesi</h2>

     <div class="space-y-6">
         {{-- PILIH TIPE (ONLINE/OFFLINE) --}}
         <div class="grid grid-cols-2 gap-4">
             {{-- Tombol Online --}}
             <button wire:click="$set('type', 'online')" type="button"
                 class="p-4 rounded-2xl border-2 flex items-center gap-3 transition-all duration-300 {{ $type == 'online' ? 'border-orange-500 bg-brand-800 shadow-lg shadow-orange-900/20' : 'border-brand-700 bg-brand-800/50 opacity-60' }}">
                 <i class="fas fa-video text-xl {{ $type == 'online' ? 'text-orange-500' : 'text-brand-400' }}"></i>
                 <div class="text-left">
                     <p class="font-bold text-white uppercase text-xs tracking-widest">Online</p>
                     <p class="text-[10px] text-brand-300">Video Call</p>
                 </div>
             </button>

             {{-- Tombol Offline --}}
             <button wire:click="$set('type', 'offline')" type="button"
                 class="p-4 rounded-2xl border-2 flex items-center gap-3 transition-all duration-300 {{ $type == 'offline' ? 'border-orange-500 bg-brand-800 shadow-lg shadow-orange-900/20' : 'border-brand-700 bg-brand-800/50 opacity-60' }}">
                 <i
                     class="fas fa-map-marker-alt text-xl {{ $type == 'offline' ? 'text-orange-500' : 'text-brand-400' }}"></i>
                 <div class="text-left">
                     <p class="font-bold text-white uppercase text-xs tracking-widest">Offline</p>
                     <p class="text-[10px] text-brand-300">Tatap Muka</p>
                 </div>
             </button>
         </div>

         {{-- DAFTAR LAYANAN --}}
         <div class="space-y-4">
             <p class="text-[10px] font-black text-brand-300 uppercase tracking-[0.2em]">Pilih Layanan
                 {{ $type }}</p>
             <div class="grid grid-cols-1 gap-4" wire:loading.class="opacity-50">
                 @forelse($filteredServices as $pService)
                     <label class="relative group cursor-pointer" wire:key="p-service-{{ $pService->id }}">
                         <input wire:model.live="service_id" type="radio"
                             wire:click="$set('service_id', {{ $pService->service_id }})" name="psicholog_service_id"
                             value="{{ $pService->service_id }}" class="peer sr-only" required>

                         <div
                             class="p-5 bg-brand-800/40 border-2 border-brand-700/50 rounded-[1.5rem] peer-checked:border-orange-500 peer-checked:bg-brand-800 transition-all duration-300">
                             <div class="flex justify-between items-center">
                                 <div class="flex items-center gap-4">
                                     <div
                                         class="w-12 h-12 bg-brand-700 rounded-2xl flex items-center justify-center text-orange-500">
                                         <i
                                             class="fas {{ $type == 'online' ? 'fa-laptop-medical' : 'fa-clinic-medical' }} text-xl"></i>
                                     </div>
                                     <div>
                                         <p class="font-bold text-white text-lg leading-tight">
                                             {{ $pService->service->name }}</p>
                                     </div>
                                 </div>
                                 <div class="text-right">
                                     <p class="text-[10px] text-brand-400 mb-1 font-bold">Mulai Dari</p>
                                     <p class="text-xl font-black text-orange-500">Rp
                                         {{ number_format($pService->price, 0, ',', '.') }}</p>
                                 </div>
                             </div>
                         </div>

                         {{-- Centang --}}
                         <div
                             class="absolute -top-2 -right-2 hidden peer-checked:flex w-7 h-7 bg-orange-500 rounded-full items-center justify-center text-white shadow-lg border-4 border-brand-900">
                             <i class="fas fa-check text-[10px]"></i>
                         </div>
                     </label>
                 @empty
                     <div class="py-10 text-center bg-brand-800/20 rounded-3xl border border-dashed border-brand-700">
                         <p class="text-brand-400 text-sm italic">Maaf, layanan {{ $type }} belum tersedia.</p>
                     </div>
                 @endforelse
             </div>

         </div>
     </div>


     <div>
         <p class="text-sm font-bold my-3">Pilih Tanggal Tersedia</p>
         <div class="flex items-center gap-4 overflow-x-auto pb-4 no-scrollbar">

             <button wire:click="semuaJadwal"
                 class="flex-shrink-0 flex flex-col items-center justify-center min-w-[100px] py-3 rounded-2xl border transition-all {{ $selectedDate == '' ? 'bg-orange-500 border-orange-400' : 'bg-brand-600 border-brand-300' }}">
                 <span class="text-sm font-black text-white">Semua</span>
                 <span class="text-sm font-black text-white">Jadwal</span>
             </button>

             {{-- Bagian Loop Tanggal --}}
             @for ($i = 0; $i < 7; $i++)
                 @php
                     $date = now()->addDays($i);
                     $dateValue = $date->format('Y-m-d');

                     // Cek Nama Hari (format English untuk dicocokkan dengan Enum DB)
                     $dayName = strtolower($date->format('l'));

                     $isWorkingDay = in_array($dayName, $workingDays);
                     $isFull = in_array($dateValue, $bookedDates);
                     $isDisabled = !$isWorkingDay || $isFull;
                     $isActive = $selectedDate == $dateValue;
                 @endphp

                 <button wire:click="$set('selectedDate', '{{ $dateValue }}')" type="button"
                     {{ $isDisabled ? 'disabled' : '' }}
                     class="flex-shrink-0 flex flex-col items-center justify-center min-w-[85px] h-20 rounded-2xl border-2 transition-all relative
        {{ $isDisabled ? 'opacity-30 cursor-not-allowed bg-gray-900 border-gray-800' : '' }}
        {{ $isActive && !$isDisabled ? 'border-orange-500 bg-brand-800 shadow-lg shadow-orange-900/40' : 'border-brand-700 bg-brand-800/50' }}">

                     <span
                         class="text-[10px] font-bold uppercase {{ $isActive ? 'text-orange-500' : 'text-brand-400' }}">
                         {{ $date->locale('id')->translatedFormat('D') }}
                     </span>

                     <span class="text-xl font-black {{ $isActive ? 'text-white' : 'text-gray-300' }}">
                         {{ $date->format('d') }}
                     </span>


                 </button>
             @endfor
         </div>
     </div>

     {{-- Tampilkan Jam Tersedia --}}
     @if ($availableTimes)
         <div class="mt-6 animate-fade-in">
             <p class="text-sm font-bold mb-3 text-white">Jam Operasional Tersedia</p>
             <div class="flex items-center gap-3">
                 <div
                     class="flex-1 p-4 bg-brand-800/60 border border-brand-700 rounded-2xl flex items-center justify-between">
                     <div class="flex items-center gap-3">
                         <div
                             class="w-10 h-10 bg-orange-500/10 rounded-xl flex items-center justify-center text-orange-500">
                             <i class="far fa-clock text-lg"></i>
                         </div>
                         <div>
                             <p class="text-[10px] text-brand-100 uppercase font-bold tracking-wider">Sesi Tersedia</p>
                             <p class="text-lg font-black text-white">
                                 {{ $availableTimes['start'] }} - {{ $availableTimes['end'] }}
                             </p>
                         </div>
                     </div>
                     <div class="text-right">
                         <span
                             class="text-[10px] bg-green-500/20 text-green-500 px-2 py-1 rounded-md font-bold uppercase">Buka</span>
                     </div>
                 </div>
             </div>
         </div>
     @elseif($selectedDate)
         {{-- Jika tanggal dipilih tapi tidak ada di weekly schedule --}}
         <div class="mt-6 p-4 bg-red-500/10 border border-red-500/50 rounded-2xl flex items-center gap-3 text-red-500">
             <i class="fas fa-exclamation-circle"></i>
             <p class="text-xs font-bold">Maaf, psikolog tidak praktek di hari
                 {{ \Carbon\Carbon::parse($selectedDate)->locale('id')->translatedFormat('l') }}.</p>
         </div>
     @endif

     <div class="mt-5 space-y-6">

         {{-- Checkbox Topik --}}
         <div class="space-y-3 ">
             <label class="text-sm font-bold text-brand-300 block">Pilih topik permasalahan</label>
             <div class="grid md:grid-cols-2 grid-cols-1 gap-3">
                 @foreach ($psychologist->topics as $topic)
                     <label
                         class="flex items-center gap-3 p-3 bg-brand-800/50 border border-brand-700 rounded-xl cursor-pointer hover:bg-brand-800 transition-all">
                         <input type="checkbox" wire:model.live="selectedTopics" value="{{ $topic->id }}"
                             class="w-5 h-5 accent-orange-500 rounded">
                         <span class="text-sm">{{ $topic->name }}</span>
                     </label>
                 @endforeach
             </div>
             @error('selectedTopics')
                 <span class="text-red-500 text-xs font-bold">{{ $message }}</span>
             @enderror
         </div>

         {{-- Deskripsi Masalah --}}
         <div class="space-y-2">
             <label class="text-sm font-bold text-brand-300">Deskripsi Masalah</label>
             <textarea wire:model="description" rows="4"
                 class="w-full bg-brand-800 border-2 {{ $errors->has('description') ? 'border-red-500' : 'border-brand-700' }} rounded-2xl p-4 focus:border-orange-500 placeholder:text-brand-300 outline-none transition-all"
                 placeholder="Ceritakan sedikit masalahmu..."></textarea>
             @error('description')
                 <span class="text-red-500 text-xs font-bold">{{ $message }}</span>
             @enderror
             <div class="flex items-center gap-3 mt-4 p-3  rounded-lg">
                 <input type="checkbox" wire:model.live="is_followup" id="is_followup" name="is_followup"
                     class="w-5 h-5 text-primary border-slate-300 rounded focus:ring-primary cursor-pointer">
                 <label for="is_followup" class="text-sm font-medium text-slate-200 cursor-pointer">
                     Saya Merupakan Client Lanjutan?
                 </label>
             </div>
         </div>

         <div class="space-y-2">
             <label class="text-sm font-bold text-brand-300">Harapan setelah konseling</label>
             <textarea wire:model="expectation" rows="3"
                 class="w-full bg-brand-800 border-2 {{ $errors->has('expectation') ? 'border-red-500' : 'border-brand-700' }} rounded-2xl p-4 focus:border-orange-500 placeholder:text-brand-300  outline-none transition-all"
                 placeholder="Apa yang ingin kamu capai?"></textarea>
             @error('expectation')
                 <span class="text-red-500 text-xs font-bold">{{ $message }}</span>
             @enderror
         </div>
     </div>

     <div>
         @if ($errors->any())
             <div class="my-4 p-4 bg-red-500/20 border border-red-500 text-red-200 rounded-2xl text-sm">
                 <ul class="list-disc list-inside">
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
         @endif
     </div>
     <button wire:click="store" wire:loading.attr="disabled"
         class="w-full my-5 py-4 bg-orange-500 hover:bg-orange-600 disabled:opacity-50 text-white rounded-2xl font-black shadow-lg shadow-orange-900/20 transition-all uppercase tracking-widest flex justify-center items-center gap-2">
         <span wire:loading wire:target="store"
             class="animate-spin inline-block w-4 h-4 border-2 border-current border-t-transparent rounded-full"></span>

         <span>Buat Janji</span>
     </button>
     </div>
 </section>
