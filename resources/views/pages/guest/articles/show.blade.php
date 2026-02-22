<x-guest-layout>
    <div class="bg-white min-h-screen pb-20">
        {{-- Progress Bar (Opsional - Muncul saat scroll) --}}
        <div class="fixed top-0 left-0 w-full h-1 bg-gray-100 z-50">
            <div id="scroll-progress" class="h-full bg-brand-600 w-0 transition-all duration-150"></div>
        </div>

        {{-- Header Artikel --}}
        <header class="pt-16 pb-8 bg-gray-50">
            <div class="max-w-full mx-auto px-4 sm:px-6">
                <nav class="flex mb-8 text-sm text-gray-500">
                    <a href="{{ route('articles.index') }}" class="hover:text-brand-600 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Artikel
                    </a>
                </nav>

                <div class="flex gap-2 mb-4">
                    @foreach($article->tags ?? [] as $tag)
                        <span class="bg-brand-100 text-brand-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    {{ $article->title }}
                </h1>

                <div class="flex items-center justify-between py-6 border-t border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-brand-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr($article->author, 0, 1)) }}
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-900">{{ $article->author }}</p>
                            <p class="text-xs text-gray-500">{{ $article->created_at->format('d M Y') }} • 5 menit baca</p>
                        </div>
                    </div>
                    
                    {{-- Share Buttons --}}
                    <div class="flex gap-3">
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-brand-600 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-brand-600 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-brand-600 hover:text-white transition">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <div class="flex flex-col lg:flex-row gap-12">
                
                {{-- Main Content --}}
                <article class="lg:w-2/3">
                    {{-- Thumbnail --}}
                    <figure class="mb-10">
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-auto rounded-3xl shadow-xl">
                    </figure>

                    {{-- Isi Artikel --}}
                    <div class="prose prose-lg prose-brand max-w-none text-gray-700 leading-relaxed">
                        {!! $article->content !!}
                    </div>
                    
                </article>

                {{-- Sidebar --}}
                <aside class="lg:w-1/3">
                    <div class="sticky top-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                            <span class="w-8 h-1 bg-brand-600 mr-3"></span>
                            Artikel Terkait
                        </h3>

                        <div class="space-y-8">
                            @foreach($relatedArticles as $related)
                            <a href="{{ route('articles.show', $related->slug) }}" class="group block">
                                <div class="flex gap-4">
                                    <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-2xl bg-gray-100">
                                        <img src="{{ Storage::url($related->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h4 class="font-bold text-gray-900 group-hover:text-brand-600 transition line-clamp-2 leading-snug mb-2">
                                            {{ $related->title }}
                                        </h4>
                                        <span class="text-xs text-gray-500">{{ $related->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Progress Bar Script
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("scroll-progress").style.width = scrolled + "%";
        };
    </script>
    @endpush
</x-guest-layout>