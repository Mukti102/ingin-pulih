<x-guest-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- LEFT SIDE: Profile Detail Card (Sticky) --}}
            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm text-center">
                        <div class="relative inline-block mb-6">
                            @if ($psychologist->user->avatar)
                                <img src="{{ Storage::url($psychologist->user->avatar) }}" alt="Avatar"
                                    class="w-40 h-40 rounded-[2.5rem] object-cover border-4 border-white shadow-md">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($psychologist->fullname) }}&size=200"
                                    class="w-40 h-40 rounded-[2.5rem] object-cover border-4 border-white shadow-md">
                            @endif
                            <div
                                class="absolute -bottom-2 -right-2 bg-green-500 w-6 h-6 rounded-full border-4 border-white">
                            </div>
                        </div>

                        <h1 class="text-2xl font-bold text-gray-900">{{ $psychologist->fullname }}</h1>
                        <p class="text-brand-600 font-semibold mb-4">{{ $psychologist->jenisPsikolog->name }}</p>

                        <div class="flex items-center justify-center gap-2 text-yellow-500 mb-6">
                            <i class="fas fa-star"></i>
                            <span class="font-bold text-gray-900">{{ number_format($averageRating, 1) }}</span>
                            <span class="text-gray-400 text-sm">({{ $totalReviews }} Ulasan)</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-50">
                            <div class="text-left">
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Pengalaman</p>
                                <p class="font-bold text-gray-900">{{ $psychologist->experience_years }} Tahun</p>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Wilayah</p>
                                <p class="font-bold text-gray-900">{{ $psychologist->wilayah->name ?? 'Online' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: Information & Booking --}}
            <div class="lg:col-span-8 space-y-8">
                {{-- About --}}
                <section class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Tentang</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $psychologist->about }}</p>
                </section>

                <section class="p-5 bg-gray-50 rounded-xl shadow-sm border border-1 border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Pendidikan</h2>
                    <div class="space-y-4"> {{-- Gunakan space-y agar antar riwayat ada jarak --}}
                        @foreach ($psychologist->educations as $edu)
                            <div class="flex flex-col border-b border-gray-100 pb-3 last:border-0">
                                <span class="text-sm font-semibold text-brand-600">
                                    {{ $edu->graduation_year }}
                                </span>
                                <h3 class="text-md font-bold text-gray-800">
                                    {{ $edu->institution_name }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ $edu->degree }} {{ $edu->major ? '— ' . $edu->major : '' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </section>
                <section>
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Topik Keahlian</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($psychologist->topics as $topic)
                            <span
                                class="px-4 py-2 bg-brand-50 text-brand-600 rounded-xl text-sm font-bold border border-brand-100">
                                # {{ $topic->name }}
                            </span>
                        @endforeach
                    </div>
                </section>
                <livewire:box-booking :psychologist="$psychologist" />
            </div>
            <x-review-sections :activeReviews="$activeReviews" />
        </div>
    </div>
</x-guest-layout>
