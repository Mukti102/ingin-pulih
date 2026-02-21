<x-client-layout>
    <div class="max-w-4xl mx-auto py-10 px-1 sm:px-6 lg:px-8">
        
        {{-- Section: Email Verification Alert --}}
        @if (auth()->user()->email_verified_at == null)
            <div class="max-w-md mx-auto my-10 p-8 bg-white rounded-2xl md:rounded-3xl shadow-xl shadow-brand-100/50 border border-brand-50 text-center">
                <div class="bg-viole-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 rotate-3">
                    <i class="fas fa-envelope-open-text text-brand-600 text-3xl"></i>
                </div>

                <h2 class="text-xl font-black text-gray-900 mb-2">Verifikasi Email Anda</h2>
                <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                    Terima kasih telah bergabung di <strong>SoulCare</strong>. Silakan verifikasi email Anda melalui tautan yang kami kirimkan untuk mengakses layanan penuh.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 font-semibold text-xs text-green-600 bg-green-50 p-4 rounded-xl border border-green-100 flex items-center justify-center">
                        <i class="fas fa-check-circle me-2"></i> Link baru telah dikirimkan!
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full py-3.5 bg-brand-600 text-white rounded-2xl font-bold hover:bg-brand-700 transition-all shadow-lg shadow-brand-200">
                        Kirim Ulang Verifikasi
                    </button>
                </form>
            </div>
        @endif

        {{-- Header Page --}}
        <div class="mb-10">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Pengaturan Akun</h1>
            <p class="text-gray-500 mt-1">Kelola profil pribadi dan keamanan akun SoulCare Anda.</p>
        </div>

        <div class="space-y-8">
            {{-- Section: Personal Information --}}
            <section class="bg-white shadow-sm border border-gray-100 rounded-2xl md:rounded-3xl overflow-hidden">
                <div class="md:p-8 p-4">
                    <div class="flex items-center gap-x-4 mb-8 border-b border-gray-50 pb-5">
                        <div class="p-3 bg-brand-50 rounded-2xl text-brand-500">
                            <i class="fas fa-id-card text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800 leading-none">Informasi Pribadi</h2>
                            <p class="text-xs text-gray-400 mt-1">Data ini digunakan untuk keperluan sesi konseling.</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                            <x-client.input 
                                label="Nama Lengkap" 
                                name="name" 
                                :value="auth()->user()->name" 
                                placeholder="Nama sesuai identitas" />

                            <x-client.input 
                                label="Alamat Email" 
                                name="email" 
                                type="email"
                                :value="auth()->user()->email" />

                            <x-client.input 
                                label="Nomor WhatsApp" 
                                name="phone" 
                                :value="auth()->user()->phone" 
                                placeholder="Contoh: 08123456789" />

                            <x-client.select label="Jenis Kelamin" name="gender">
                                <option value="">Pilih...</option>
                                <option value="laki-laki" {{ old('gender', auth()->user()->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender', auth()->user()->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </x-client.select>

                            <x-client.input 
                                label="Tanggal Lahir" 
                                name="date_of_birth" 
                                type="date"
                                :value="auth()->user()->date_of_birth?->format('Y-m-d')" />

                            <x-client.input 
                                label="Update Foto Profil" 
                                name="avatar" 
                                type="file" />
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="px-8 py-3 bg-brand-500 text-white rounded-2xl text-sm font-bold hover:bg-brand-700 transition-all shadow-lg shadow-brand-100">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            {{-- Section: Security --}}
            <section class="bg-white shadow-sm border border-gray-100 rounded-2xl md:rounded-3xl overflow-hidden">
                <div class="md:p-8 p-4">
                    <div class="flex items-center gap-x-4 mb-8 border-b border-gray-50 pb-5">
                        <div class="p-3 bg-amber-50 rounded-2xl text-amber-600">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800 leading-none">Keamanan Akun</h2>
                            <p class="text-xs text-gray-400 mt-1">Pastikan kata sandi Anda kuat dan rahasia.</p>
                        </div>
                    </div>

                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="max-w-md space-y-2">
                            <x-client.input 
                                label="Kata Sandi Saat Ini" 
                                name="current_password" 
                                type="password" />

                            <x-client.input 
                                label="Kata Sandi Baru" 
                                name="password" 
                                type="password" />

                            <x-client.input 
                                label="Konfirmasi Kata Sandi" 
                                name="password_confirmation" 
                                type="password" />
                        </div>

                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="px-8 py-3 bg-gray-900 text-white rounded-2xl text-sm font-bold hover:bg-black transition-all shadow-lg shadow-gray-200">
                                Perbarui Keamanan
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        {{-- Section: CTA for Psychologists --}}
        @if (auth()->user()->email_verified_at)
            <div class="mt-12 p-8 bg-gradient-to-r from-brand-600 to-brand-400 rounded-[1rem] md:rounded-[2rem] text-center shadow-xl shadow-brand-200">
                <h3 class="text-xl font-bold text-white mb-2">Ingin Membantu Sesama?</h3>
                <p class="text-brand-100 text-sm mb-6 max-w-lg mx-auto">
                    Bergabunglah sebagai mitra psikolog kami dan bantu klien menemukan ketenangan jiwa mereka.
                </p>
                <a href="{{route('register.psychologist')}}" 
                   class="inline-flex items-center px-8 py-3 bg-white text-brand-600 rounded-full text-sm font-black hover:bg-viole-50 transition-colors uppercase tracking-widest">
                    <i class="fas fa-user-md me-2"></i> Daftar sebagai Psikolog
                </a>
            </div>
        @endif

    </div>
</x-client-layout>