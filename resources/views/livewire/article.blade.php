<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Header & Search tetep kelihatan --}}
    <div class="relative mb-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900">Artikel & <span class="text-brand-600">Edukasi</span>
                </h1>
                <p class="mt-2 text-gray-600">Temukan wawasan terbaru seputar kesehatan mental dan psikologi.</p>
            </div>

            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
                <input wire:model.live.debounce.300ms="search" type="text"
                    class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-600 focus:border-brand-600 sm:text-sm transition duration-150 ease-in-out"
                    placeholder="Cari judul artikel...">
            </div>
        </div>
    </div>

    {{-- 1. SKELETON LOADING STATE --}}
    <div wire:loading.grid class="w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-pulse">
            @for ($i = 0; $i < 6; $i++)
                <div class="bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden h-[400px]">
                    <div class="bg-gray-200 h-48 w-full"></div>
                    <div class="p-6 space-y-4">
                        <div class="h-4 bg-gray-200 rounded w-1/3"></div>
                        <div class="h-6 bg-gray-200 rounded w-full"></div>
                        <div class="h-6 bg-gray-200 rounded w-5/6"></div>
                        <div class="space-y-2">
                            <div class="h-3 bg-gray-200 rounded w-full"></div>
                            <div class="h-3 bg-gray-200 rounded w-full"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- 2. ACTUAL CONTENT --}}
    <div wire:loading.remove>
        @if ($all_articles->count() > 0)
            {{-- Section Featured --}}
            @if ($search == '')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                    {{-- Jumbo Card Left --}}
                    <div class="lg:col-span-2 group">
                        <a href="{{ route('showArticle', $featured->slug) }}" class="relative block overflow-hidden rounded-3xl bg-gray-100 aspect-video">
                            <img src="{{ Storage::url($featured->thumbnail) }}"
                                class="object-cover w-full h-full transition duration-500 group-hover:scale-105">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-8">
                                <div class="flex gap-2 mb-3">
                                    @foreach ($featured->tags ?? [] as $tag)
                                        <span
                                            class="bg-brand-600 text-white text-xs px-3 py-1 rounded-full">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                <h2 class="text-3xl font-bold text-white mb-2">{{ $featured->title }}</h2>
                                <p class="text-gray-200 line-clamp-2 mb-4">{!! Str::limit(strip_tags($featured->content), 150) !!}</p>
                                <div class="flex items-center text-white text-sm">
                                    <span class="font-semibold">{{ $featured->author }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $featured->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    {{-- Right Side Small Cards --}}
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Terbaru Lainnya</h3>
                        @foreach ($all_articles->take(3) as $item)
                            <a href="{{ route('showArticle', $item->slug) }}" class="flex gap-4 group">
                                <div class="flex-shrink-0 w-24 h-24 overflow-hidden rounded-xl bg-gray-100">
                                    <img src="{{ Storage::url($item->thumbnail) }}"
                                        class="object-cover w-full h-full group-hover:scale-110 transition duration-300">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4
                                        class="font-bold text-gray-900 group-hover:text-brand-600 transition line-clamp-2">
                                        {{ $item->title }}</h4>
                                    <span
                                        class="text-xs text-gray-500 mt-1">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Grid Articles --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($all_articles as $article)
                    <div
                        class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300">
                        <div class="relative h-48">
                            <img src="{{ Storage::url($article->thumbnail) }}" class="w-full h-full object-cover">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 backdrop-blur-sm text-brand-600 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-lg shadow-sm">
                                    {{ $article->tags[0] ?? 'Umum' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                <span>{{ $article->author }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 hover:text-brand-600 transition">
                                <a href="{{ route('showArticle', $article->slug) }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-6">
                                {!! Str::limit(strip_tags($article->content), 100) !!}
                            </p>
                            <a href="{{ route('showArticle', $article->slug) }}" class="inline-flex items-center text-brand-600 font-bold text-sm group">
                                Baca Selengkapnya
                                <i
                                    class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition duration-300"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @include('partials.guest.paginate-article')
        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <i class="fas fa-newspaper text-6xl text-gray-200 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900">Tidak ada artikel ditemukan</h3>
                <p class="text-gray-500">Coba gunakan kata kunci pencarian yang lain.</p>
            </div>
        @endif
    </div>
</div>
