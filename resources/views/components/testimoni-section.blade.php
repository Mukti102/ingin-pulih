 {{-- testimoni --}}
 <section class="py-24 bg-white overflow-hidden">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

         <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
             <div class="max-w-2xl">
                 <h2 class="text-brand-600 font-bold tracking-widest uppercase text-sm mb-3">Kisah Pemulihan</h2>
                 <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                     Mereka yang Telah Menemukan Kembali <span class="text-brand-600">Ketenangan</span>
                 </h3>
             </div>
             <div class="flex gap-2">
                 <button
                     class="swiper-prev w-12 h-12 rounded-full border border-brand-200 flex items-center justify-center text-brand-600 hover:bg-brand-600 hover:text-white transition-all cursor-pointer">
                     <i class="fas fa-arrow-left"></i>
                 </button>
                 <button
                     class="swiper-next w-12 h-12 rounded-full bg-brand-600 flex items-center justify-center text-white hover:bg-brand-700 shadow-lg shadow-brand-200 transition-all cursor-pointer">
                     <i class="fas fa-arrow-right"></i>
                 </button>
             </div>
         </div>

         <div class="swiper myTestimonialSwiper overflow-visible">
             <div class="swiper-wrapper">
                 <div class="swiper-slide">
                     <div
                         class="bg-brand-50/50 p-8 rounded-3xl border border-transparent hover:border-brand-200 transition-all duration-300 relative h-full">
                         <div class="text-brand-200 absolute top-8 right-8">
                             <i class="fas fa-quote-right fa-3x opacity-20"></i>
                         </div>
                         <div class="flex text-yellow-400 mb-4">
                             <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                 class="fas fa-star"></i><i class="fas fa-star"></i>
                         </div>
                         <p class="text-gray-700 italic mb-8">"Awalnya ragu untuk cerita lewat video call, tapi
                             psikolognya sangat suportif. Sekarang saya merasa jauh lebih tenang."</p>
                         <div class="flex items-center gap-4">
                             <div
                                 class="w-12 h-12 rounded-full bg-brand-200 flex items-center justify-center text-brand-700 font-bold">
                                 AS</div>
                             <div>
                                 <h4 class="font-bold text-gray-900">Andini S.</h4>
                                 <p class="text-xs text-brand-600">Karyawan Swasta</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div
                         class="bg-brand-50/50 p-8 rounded-3xl border border-transparent hover:border-brand-200 transition-all duration-300 relative h-full">
                         <div class="text-brand-200 absolute top-8 right-8">
                             <i class="fas fa-quote-right fa-3x opacity-20"></i>
                         </div>
                         <div class="flex text-yellow-400 mb-4">
                             <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                 class="fas fa-star"></i><i class="fas fa-star"></i>
                         </div>
                         <p class="text-gray-700 italic mb-8">"Awalnya ragu untuk cerita lewat video call, tapi
                             psikolognya sangat suportif. Sekarang saya merasa jauh lebih tenang."</p>
                         <div class="flex items-center gap-4">
                             <div
                                 class="w-12 h-12 rounded-full bg-brand-200 flex items-center justify-center text-brand-700 font-bold">
                                 AS</div>
                             <div>
                                 <h4 class="font-bold text-gray-900">Andini S.</h4>
                                 <p class="text-xs text-brand-600">Karyawan Swasta</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="swiper-slide">
                     <div
                         class="bg-brand-50/50 p-8 rounded-3xl border border-transparent hover:border-brand-200 transition-all duration-300 relative h-full">
                         <div class="text-brand-200 absolute top-8 right-8">
                             <i class="fas fa-quote-right fa-3x opacity-20"></i>
                         </div>
                         <div class="flex text-yellow-400 mb-4">
                             <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                 class="fas fa-star"></i><i class="fas fa-star"></i>
                         </div>
                         <p class="text-gray-700 italic mb-8">"Awalnya ragu untuk cerita lewat video call, tapi
                             psikolognya sangat suportif. Sekarang saya merasa jauh lebih tenang."</p>
                         <div class="flex items-center gap-4">
                             <div
                                 class="w-12 h-12 rounded-full bg-brand-200 flex items-center justify-center text-brand-700 font-bold">
                                 AS</div>
                             <div>
                                 <h4 class="font-bold text-gray-900">Andini S.</h4>
                                 <p class="text-xs text-brand-600">Karyawan Swasta</p>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <script>
     var swiper = new Swiper(".myTestimonialSwiper", {
         slidesPerView: 1,
         spaceBetween: 30,
         loop: true,
         autoplay: {
             delay: 5000,
             disableOnInteraction: false,
         },
         navigation: {
             nextEl: ".swiper-next",
             prevEl: ".swiper-prev",
         },
         breakpoints: {
             640: {
                 slidesPerView: 2,
             },
             1024: {
                 slidesPerView: 3,
             },
         },
     });
 </script>
