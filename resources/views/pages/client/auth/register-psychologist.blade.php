<x-layout.auth>
    <div class="text-center mb-8">
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Pendaftaran Psikolog</h1>
        <p class="text-sm text-gray-500 mt-2">Lengkapi data profesional Anda untuk bergabung dengan jaringan SoulCare.
        </p>
    </div>

    <form action="{{ route('psychologs.store') }}" enctype="multipart/form-data" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <div class="space-y-4">
            <x-client.input label="Nama Lengkap & Gelar" name="fullname"
                placeholder="Contoh: Dr. Budi Utomo, M.Psi, Psikolog" :value="old('fullname', auth()->user()->name)" />

            <div class="mb-4">
                <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-1">Tentang
                    Anda</label>
                <textarea name="about" rows="3"
                    placeholder="Ceritakan singkat mengenai spesialisasi dan pendekatan konseling Anda..."
                    class="w-full px-4 py-2.5 rounded-lg border {{ $errors->has('about') ? 'border-red-400 bg-red-50' : 'border-gray-200' }} focus:border-violet-500 focus:ring-2 focus:ring-violet-200 transition-all outline-none text-sm">{{ old('about') }}</textarea>
                @error('about')
                    <p class="text-red-500 text-[10px] mt-1 font-semibold"><i class="fas fa-exclamation-circle me-1"></i>
                        {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Section 2: Kategori & Wilayah --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
            <x-client.select label="Jenis Psikolog" name="jenis_psikolog">
                <option value="">Pilih Jenis...</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('jenis_psikolog') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </x-client.select>

            <x-client.select label="Wilayah Praktik" name="wilayah_id">
                <option value="">Pilih Wilayah...</option>
                @foreach ($wilayahs as $wilayah)
                    <option value="{{ $wilayah->id }}" {{ old('wilayah_id') == $wilayah->id ? 'selected' : '' }}>
                        {{ $wilayah->name }}
                    </option>
                @endforeach
            </x-client.select>
        </div>
        {{-- Section: Topics / Spesialisasi --}}
        <div class="mb-6">
            <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-3">
                Bidang Spesialisasi (Topik)
            </label>

            <div class="grid grid-cols-2 gap-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                @foreach ($topics as $topic)
                    <div class="flex items-center">
                        <input type="checkbox" name="topics[]" id="topic-{{ $topic->id }}"
                            value="{{ $topic->id }}"
                            {{ is_array(old('topics')) && in_array($topic->id, old('topics')) ? 'checked' : '' }}
                            class="w-4 h-4 text-violet-600 border-gray-300 rounded focus:ring-violet-500 cursor-pointer">
                        <label for="topic-{{ $topic->id }}"
                            class="ml-2 text-sm text-gray-700 cursor-pointer select-none">
                            {{ $topic->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            @error('topics')
                <p class="text-red-500 text-[10px] mt-1 font-semibold">
                    <i class="fas fa-exclamation-circle me-1"></i> Pilih minimal satu topik keahlian.
                </p>
            @enderror
        </div>

        {{-- Section 3: Legalitas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
            <x-client.input label="Nomor SIPP" name="SIPP" placeholder="Masukkan No. SIPP" />

            <x-client.input label="Nomor STR" name="STR" placeholder="Masukkan No. STR" />
        </div>

        <x-client.input label="Pengalaman Klinik (Tahun)" name="experience_years" type="number"
            placeholder="Contoh: 5" />
        <x-client.input label="Upload Dokumen Legal (STR / SIPP)" type="file" name="document_legal" />

        <div class="pt-4 border-t border-gray-50">
            <button type="submit"
                class="w-full py-3.5 bg-violet-600 text-white rounded-2xl font-bold hover:bg-violet-700 transition-all shadow-lg shadow-violet-200 flex items-center justify-center">
                <i class="fas fa-paper-plane me-2 text-sm"></i> Kirim Aplikasi Pendaftaran
            </button>
            <p class="text-[10px] text-gray-400 mt-4 text-center leading-relaxed">
                Aplikasi Anda akan ditinjau oleh tim kami dalam waktu 1-3 hari kerja. Pastikan data SIPP dan STR valid.
            </p>
        </div>
    </form>
</x-layout.auth>
