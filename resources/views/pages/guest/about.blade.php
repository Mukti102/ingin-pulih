<x-guest-layout>

<div class="bg-white min-h-screen">
    
    <div class="container mx-auto px-6 py-16 text-center">
        <span class="text-brand-600 font-bold tracking-widest uppercase text-sm">Tentang Bicarakan</span>
        <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mt-4 leading-tight max-w-4xl mx-auto">
            Kami percaya bahwa psikologi dapat membuat hidup manusia menjadi lebih baik.
        </h1>
    </div>

    <section class="py-12 bg-white overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="relative">
                    <div class="absolute -inset-4 bg-brand-50 rounded-3xl -rotate-3 z-0"></div>
                    <img src="https://storage.googleapis.com/pendaftaran-production/counselor_avatar/tt27uEV6IW89XPdC1V3oggI3PgzukkE9L1qWbqCw.png" 
                         alt="Founder" 
                         class="relative z-10 w-full md:w-[400px] rounded-2xl shadow-xl object-cover">
                    <div class="absolute bottom-6 left-6 z-20 text-white">
                        <h3 class="text-xl font-bold">Andreas Handani</h3>
                        <p class="text-sm opacity-90">— Founder & CEO</p>
                    </div>
                </div>

                <div class="md:w-1/2 space-y-6 text-gray-600 leading-relaxed text-lg">
                    <p>Kami percaya, karena kami sudah merasakannya sendiri.</p>
                    <p>
                        Bicarakan dimulai dari pengalaman saya mengatasi masalah trauma psikologis di masa lalu saya, serta bertumbuh untuk menjadi manusia yang lebih utuh.
                    </p>
                    <p>
                        Melalui pengalaman pribadi, saya belajar dan meyakini bahwa orang yang mencari bantuan psikolog bukanlah individu yang lemah — <span class="text-gray-900 font-bold italic">melainkan justru kuat.</span>
                    </p>
                    <p>
                        Karena tidak ada hal yang lebih mengagumkan dari seorang individu yang jujur dengan diri sendiri, berani untuk membuka diri mereka kepada orang lain.
                    </p>
                    <div class="pt-4">
                        <span class="text-brand-600 font-bold">Salam #AngkatBicara!</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
                    <p class="text-gray-500 mt-2">Dukungan profesional untuk setiap langkah perjalananmu.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($services as $service)
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 group-hover:bg-brand-600 group-hover:text-white transition-colors">
                            <i class="fas fa-user-md text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                            {{ $service->duration_minutes }} Menit
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->name }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        {{ $service->description }}
                    </p>
                    
                    <hr class="my-6 border-gray-50">
                    
                    <a href="#" class="text-brand-600 font-bold text-sm inline-flex items-center group">
                        Lihat Detail 
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold mb-8">Visi & Misi</h2>
                <div class="grid md:grid-cols-2 gap-12 text-left">
                    <div class="border-l-4 border-brand-600 pl-6">
                        <h4 class="font-bold text-gray-900 mb-2">Visi</h4>
                        <p class="text-gray-600 text-sm">Menjadikan kesehatan mental sebagai prioritas utama yang mudah dijangkau oleh seluruh lapisan masyarakat.</p>
                    </div>
                    <div class="border-l-4 border-gray-200 pl-6">
                        <h4 class="font-bold text-gray-900 mb-2">Misi</h4>
                        <p class="text-gray-600 text-sm">Menghubungkan individu dengan psikolog profesional melalui teknologi yang aman dan nyaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


</x-guest-layout>