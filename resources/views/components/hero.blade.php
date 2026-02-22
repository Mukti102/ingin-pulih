  <div class="relative bg-white overflow-hidden">
      <div
          class="absolute top-0 right-0 -mt-20 -mr-20 w-[600px] h-[600px] bg-brand-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
      </div>
      <div
          class="absolute bottom-0 left-0 -mb-20 -ml-20 w-[500px] h-[500px] bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
      </div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="relative z-10 py-10 sm:py-20 lg:py-20 lg:max-w-2xl">
              <div
                  class="inline-flex items-center space-x-2 bg-brand-50 border border-brand-100 px-3 py-1 rounded-full mb-6">
                  <span class="flex h-2 w-2 rounded-full bg-brand-600"></span>
                  <span class="text-sm font-semibold text-brand-700">Tersedia Konsultasi Online Gratis Pertama</span>
              </div>

              <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 leading-[1.1]">
                  Pulihkan <span class="text-brand-600">Kesehatan Mental</span> Anda Bersama Ahli.
              </h1>

              <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">
                  Temukan ruang aman untuk bercerita. Bersama tim psikolog berlisensi kami, mari langkah demi langkah
                  merajut kembali senyuman dan ketenangan pikiran Anda.
              </p>

              <div class="mt-10 flex flex-col sm:flex-row gap-4">
                  <a href="{{route('list.psychologs')}}"
                      class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-brand-600 hover:bg-brand-700 shadow-xl shadow-brand-200 transition-all duration-300 transform hover:-translate-y-1 hover:scale-105">
                      <i class="fas fa-calendar-check mr-2"></i> Buat Janji Sekarang
                  </a>
                  <a href="#tentang"
                      class="inline-flex items-center justify-center px-8 py-4 border-2 border-brand-100 text-base font-bold rounded-2xl text-brand-700 bg-white hover:bg-brand-50 transition-all duration-300">
                      Pelajari Layanan
                  </a>
              </div>

              <div class="mt-12 flex items-center space-x-8">
                  <div class="flex flex-col">
                      <span class="text-2xl font-bold text-gray-900">50+</span>
                      <span class="text-sm text-gray-500">Psikolog Ahli</span>
                  </div>
                  <div class="w-px h-8 bg-gray-200"></div>
                  <div class="flex flex-col">
                      <span class="text-2xl font-bold text-gray-900">10k+</span>
                      <span class="text-sm text-gray-500">Sesi Selesai</span>
                  </div>
                  <div class="w-px h-8 bg-gray-200"></div>
                  <div class="flex items-center">
                      <div class="flex -space-x-2">
                          <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=1"
                              alt="">
                          <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=2"
                              alt="">
                          <img class="w-8 h-8 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=3"
                              alt="">
                      </div>
                      <span class="ml-3 text-sm text-gray-500 font-medium">4.9/5 Rating</span>
                  </div>
              </div>
          </div>
      </div>

      <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 flex items-center justify-center p-12 lg:p-24">
          <div class="relative w-full max-w-lg">
              {{-- <div
                  class="absolute -top-4 -left-4 w-72 h-72 bg-brand-200 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob">
              </div> --}}

              <img class="relative rounded-3xl  transform transition-transform duration-500 hover:rotate-2"
                  src="https://i.pinimg.com/736x/49/b8/fd/49b8fd19a81f4e49b7cc6ac711531dbc.jpg"
                  alt="Mental Health Consultation">

              <div
                  class="absolute -bottom-6 -left-10 bg-white p-4 rounded-2xl shadow-2xl flex items-center space-x-4 border border-brand-50 animate-bounce-slow">
                  <div class="bg-green-100 text-green-600 p-2 rounded-xl">
                      <i class="fas fa-shield-alt fa-lg"></i>
                  </div>
                  <div>
                      <p class="text-xs text-gray-500 font-medium">Privasi Terjamin</p>
                      <p class="text-sm font-bold text-gray-900">100% Anonim & Aman</p>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <style>
      @keyframes blob {
          0% {
              transform: translate(0px, 0px) scale(1);
          }

          33% {
              transform: translate(30px, -50px) scale(1.1);
          }

          66% {
              transform: translate(-20px, 20px) scale(0.9);
          }

          100% {
              transform: translate(0px, 0px) scale(1);
          }
      }

      .animate-blob {
          animation: blob 7s infinite;
      }

      .animation-delay-2000 {
          animation-delay: 2s;
      }

      @keyframes bounce-slow {

          0%,
          100% {
              transform: translateY(0);
          }

          50% {
              transform: translateY(-10px);
          }
      }

      .animate-bounce-slow {
          animation: bounce-slow 3s infinite ease-in-out;
      }
  </style>
