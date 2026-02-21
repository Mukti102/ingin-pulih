 <section class="mt-12">
     <div class="flex items-center justify-between mb-6">
         <h2 class="text-xl font-bold text-gray-900">Ulasan Klien</h2>
         <div class="text-sm text-gray-500 font-medium">
             Menampilkan {{ $activeReviews->count() }} ulasan terbaru
         </div>
     </div>

     @if ($activeReviews->isEmpty())
         <div class="p-10 bg-gray-50 rounded-[2rem] border border-dashed border-gray-200 text-center">
             <i class="fas fa-comment-dots text-gray-300 text-3xl mb-3"></i>
             <p class="text-gray-500 italic">Belum ada ulasan untuk psikolog ini.</p>
         </div>
     @else
         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             @foreach ($activeReviews as $review)
                 <div
                     class="p-6 bg-gray-100 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                     <div class="flex items-center justify-between mb-4">
                         <div class="flex items-center gap-1 text-yellow-400 text-[10px]">
                             @for ($i = 1; $i <= 5; $i++)
                                 <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                             @endfor
                         </div>
                         <span class="text-[10px] text-gray-400 font-medium italic">
                             {{ $review->created_at->diffForHumans() }}
                         </span>
                     </div>

                     <p class="text-sm text-gray-600 leading-relaxed italic mb-4">
                         "{{ $review->comment }}"
                     </p>

                     <div class="flex items-center gap-3">
                         <div
                             class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 text-[10px] font-bold">
                             {{ strtoupper(substr($review->booking->user->name, 0, 1)) }}
                         </div>
                         <p class="text-xs font-bold text-gray-900">{{ $review->booking->user->name }}</p>
                     </div>
                 </div>
             @endforeach
         </div>
     @endif
 </section>
