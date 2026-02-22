 @if ($booking->status == 'complete' && !$booking->review)
     <div class="mt-4 p-4 bg-brand-50 rounded-2xl border border-brand-100 flex items-center justify-between">
         <div>
             <h5 class="text-sm font-bold text-slate-900">Bagaimana sesi Anda?</h5>
             <p class="text-[10px] text-slate-500">Bantu orang lain dengan memberikan ulasan untuk
                 psikolog ini.</p>
         </div>
         <button type="button" onclick="openReviewModal()"
             class="bg-brand-600 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition-all">
             Berikan Ulasan
         </button>
     </div>
 @elseif($booking->review)
     <div class="mt-4 p-4 bg-slate-50 rounded-2xl border border-slate-100 text-center">
         <p class="text-xs text-slate-500 italic">Anda telah memberikan ulasan untuk sesi ini. Terima
             kasih!</p>
     </div>
 @endif
 <script>
     function openReviewModal() {
         document.getElementById('reviewModal').classList.remove('hidden');
         document.body.style.overflow = 'hidden';
     }

     function closeReviewModal() {
         document.getElementById('reviewModal').classList.add('hidden');
         document.body.style.overflow = 'auto';
     }
 </script>
