<div
                class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-2xl mt-8 shadow-sm">
                <div class="flex flex-1 justify-between sm:hidden">
                    <button wire:click="previousPage"
                        class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</button>
                    <button wire:click="nextPage"
                        class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</button>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-bold">{{ $all_articles->firstItem() }}</span>
                            sampai <span class="font-bold">{{ $all_articles->lastItem() }}</span>
                            dari <span class="font-bold">{{ $all_articles->total() }}</span> Artikel
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px gap-2" aria-label="Pagination">
                            {{-- Tombol Previous --}}
                            <button wire:click="previousPage" @disabled($all_articles->onFirstPage())
                                class="px-4 py-2 rounded-xl border border-gray-200 text-sm font-bold {{ $all_articles->onFirstPage() ? 'text-gray-300' : 'text-brand-600 hover:bg-brand-50' }}">
                                <i class="fas fa-chevron-left"></i>
                            </button>

                            {{-- Angka Halaman --}}
                            @foreach ($all_articles->getUrlRange(1, $all_articles->lastPage()) as $page => $url)
                                <button wire:click="gotoPage({{ $page }})"
                                    class="w-10 h-10 rounded-xl text-sm font-bold transition-all {{ $page == $all_articles->currentPage() ? 'bg-brand-600 text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100' }}">
                                    {{ $page }}
                                </button>
                            @endforeach

                            {{-- Tombol Next --}}
                            <button wire:click="nextPage" @disabled(!$all_articles->hasMorePages())
                                class="px-4 py-2 rounded-xl border border-gray-200 text-sm font-bold {{ !$all_articles->hasMorePages() ? 'text-gray-300' : 'text-brand-600 hover:bg-brand-50' }}">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>