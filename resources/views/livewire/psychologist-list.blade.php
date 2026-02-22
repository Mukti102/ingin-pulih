<div class="max-w-7xl mx-auto px-4 py-12">

    <div class="flex flex-col lg:flex-row gap-10">

        <aside class="w-full lg:w-1/4">
            <div class="sticky top-24">
                <h2 class="text-xl font-black text-gray-900 mb-8 tracking-tight">Cari Ahli</h2>

                <div class="mb-8 relative group">
                    <input wire:model.live="search" type="text" placeholder="Nama psikolog..."
                        class="w-full bg-brand-50 border-none rounded-2xl py-4 pl-12 focus:ring-2 focus:ring-brand-500 transition-all">
                    <i
                        class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-brand-300 group-focus-within:text-brand-600"></i>
                </div>

                <div class="space-y-6">
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Jenis
                            Layanan</h4>
                        <div class="space-y-3">
                            @foreach ($services as $service)
                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input value="{{ $service->id }}" type="checkbox"
                                            wire:model.live="selectedServices"
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-brand-200 checked:bg-brand-600 transition-all">
                                        <i
                                            class="fas fa-check absolute opacity-0 peer-checked:opacity-100 text-white text-[10px] left-1"></i>
                                    </div>
                                    <span
                                        class="ml-3 text-sm text-gray-600 group-hover:text-brand-600 transition-colors">{{ $service->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Wilayah
                            Praktik</h4>
                        <div class="space-y-3">
                            @foreach ($wilayahs as $wilayah)
                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="checkbox" wire:model.live="selectedWilayahs"
                                            value="{{ $wilayah->id }}"
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-brand-200 checked:bg-brand-600 transition-all">
                                        <i
                                            class="fas fa-check absolute opacity-0 peer-checked:opacity-100 text-white text-[10px] left-1"></i>
                                    </div>
                                    <span
                                        class="ml-3 text-sm text-gray-600 group-hover:text-brand-600 transition-colors">{{ $wilayah->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Jenis
                            Psikolog</h4>
                        <div class="space-y-3">
                            @foreach ($types as $type)
                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input wire:model.live="selectedTypes" type="checkbox"
                                            value="{{ $type->id }}"
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-brand-200 checked:bg-brand-600 transition-all">
                                        <i
                                            class="fas fa-check absolute opacity-0 peer-checked:opacity-100 text-white text-[10px] left-1"></i>
                                    </div>
                                    <span
                                        class="ml-3 text-sm text-gray-600 group-hover:text-brand-600 transition-colors">{{ $type->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Topik
                            Keahlian</h4>
                        <div class="space-y-3">
                            @foreach ($topics as $topic)
                                <label class="flex items-center cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input wire:model.live="selectedTopics" type="checkbox"
                                            value="{{ $topic->id }}"
                                            class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-brand-200 checked:bg-brand-600 transition-all">
                                        <i
                                            class="fas fa-check absolute opacity-0 peer-checked:opacity-100 text-white text-[10px] left-1"></i>
                                    </div>
                                    <span
                                        class="ml-3 text-sm text-gray-600 group-hover:text-brand-600 transition-colors">{{ $topic->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="w-full lg:w-3/4">

            <div class="flex flex-col lg:flex-row gap-4 mb-10">
                <div class="relative w-full lg:w-1/4 group">
                    <label
                        class="absolute -top-2 left-4 px-2 bg-white text-[10px] font-black text-brand-600 uppercase tracking-widest z-10">
                        Pilih Hari
                    </label>
                    <div class="relative">
                        <select wire:model.live="day"
                            class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 pl-12 pr-10 appearance-none focus:border-brand-600 focus:ring-4 focus:ring-brand-50 transition-all outline-none text-sm font-bold text-gray-700 cursor-pointer">
                            <option value="">Semua Hari</option>
                            <option value="monday">Senin</option>
                            <option value="tuesday">Selasa</option>
                            <option value="wednesday">Rabu</option>
                            <option value="thursday">Kamis</option>
                            <option value="friday">Jumat</option>
                            <option value="saturday">Sabtu</option>
                            <option value="sunday">Minggu</option>
                        </select>
                        <i
                            class="fas fa-calendar-day absolute left-4 top-1/2 -translate-y-1/2 text-brand-400 group-focus-within:text-brand-600"></i>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-300 text-xs pointer-events-none"></i>
                    </div>
                </div>

                <div class="relative w-full lg:w-3/4 group">
                    <label
                        class="absolute -top-2 left-4 px-2 bg-white text-[10px] font-black text-brand-600 uppercase tracking-widest z-10">
                        Pencarian
                    </label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" wire:model.live="search" value="{{ $search }}"
                                placeholder="Masukkan kata kunci (nama, tentang, atau keluhan)..."
                                class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 pl-12 pr-4 focus:border-brand-600 focus:ring-4 focus:ring-brand-50 transition-all outline-none text-sm font-medium text-gray-700">
                            <i
                                class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-brand-400 group-focus-within:text-brand-600"></i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mb-1">
                <div class="flex items-center gap-4 overflow-x-auto pb-4 no-scrollbar">
                    <x-date-button />
                    <button wire:click="semuaJadwal"
                        class="flex-shrink-0 flex flex-col items-center justify-center min-w-[100px] py-3 rounded-2xl border border-gray-300 bg-brand-600 transition-all group">
                        <span class="text-sm font-black text-gray-100">Semua</span>
                        <span class="text-sm font-black text-gray-100">Jadwal</span>
                    </button>
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $date = now()->addDays($i);
                            $dateValue = $date->format('Y-m-d');
                        @endphp
                        <button wire:click="$set('selectedDate', '{{ $dateValue }}')"
                            class="flex-shrink-0 flex flex-col items-center justify-center min-w-[80px] py-3 rounded-2xl border hover:border-brand-300 hover:bg-brand-50 transition-all group {{ $selectedDate == $dateValue ? 'border-brand-300 bg-brand-50' : 'border border-gray-300' }}">
                            <span
                                class="text-[10px] font-bold {{ $selectedDate == $dateValue ? 'text-brand-500' : 'text-gray-400' }} uppercase uppercase group-hover:text-brand-600">
                                {{ $date->locale('id')->translatedFormat('D') }}
                            </span>
                            <span
                                class="text-lg font-black {{ $selectedDate == $dateValue ? 'text-black' : 'text-gray-900' }}">
                                {{ $date->format('d') }}
                            </span>
                        </button>
                    @endfor
                </div>
            </div>
            <div class="relative min-h-[400px]">
                <div wire:loading.delay.shorter class="w-full space-y-6">
                    @for ($i = 0; $i < 3; $i++)
                        <x-psycholog-card-skeleton />
                    @endfor
                </div>

                <div wire:loading.remove class="space-y-6">
                    @forelse ($psychologists as $psikolog)
                        <x-card-psikolog :psikolog="$psikolog" />
                    @empty
                        <div
                            class="flex flex-col items-center justify-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                            <i class="fas fa-user-md text-5xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-bold text-gray-900">Tidak ada psikolog ditemukan</h3>
                            <p class="text-gray-500 text-sm">Coba ubah filter atau pencarian Anda.</p>
                        </div>
                    @endforelse
                    @include('partials.guest.paginate')
                </div>
            </div>
        </main>
    </div>
</div>
