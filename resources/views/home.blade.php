<x-app-layout>
    <x-slot name="title">Beranda - Repositori Riset Cahaya Ilmu Bangsa</x-slot>
    <x-slot name="description">Temukan jutaan artikel ilmiah, naskah riset, dan publikasi pendidikan terakreditasi.</x-slot>

    <!-- Main Hero Banner with Inner Rounded Card Container -->
    <div class="px-4 pb-8 pt-4 sm:px-6 lg:px-8">
        <section class="reveal relative flex min-h-[50vh] sm:min-h-[80vh] items-center justify-center overflow-hidden rounded-[28px] bg-slate-950 bg-cover bg-center text-white"
            style="background-image: linear-gradient(to bottom, rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.92)), url('{{ asset('assets/images/background.png') }}');">
            <div class="mx-auto w-full max-w-[90vw] px-6 py-12">

                <!-- Top Pill Badge -->
                <div class="reveal relative z-10 flex items-center justify-between delay-100">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-white backdrop-blur-md">
                        <span>⚡</span>
                        <span>Repositori Riset Buka-Akses</span>
                    </div>
                </div>

                <!-- Central Hero Headline & Floating Widgets -->
                <div class="relative z-10 my-auto max-w-4xl space-y-6 py-12">

                    <img class="w-full max-w-xs sm:max-w-md lg:max-w-2xl" src="{{ asset('assets/images/logo-white.svg') }}" alt="Logo CIB">

                    <p class="reveal max-w-2xl text-sm font-light leading-relaxed text-slate-300 delay-300 sm:text-base lg:text-lg">
                        Jelajahi naskah ilmiah, ulasan akademis, dan jurnal terakreditasi. Didesain untuk para peneliti yang percaya setiap wawasan harus dapat diakses bebas.
                    </p>

                    <!-- Search Input inside Hero Card -->
                    <div class="reveal delay-400 max-w-2xl pt-4">
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <div class="relative flex items-center">
                                <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 sm:left-4">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <input type="text" name="q" placeholder="Cari artikel, penulis, naskah, DOI..." required
                                    class="w-full rounded-full border border-white/20 bg-white/10 py-3.5 pl-10 pr-24 text-xs text-white placeholder-slate-400 shadow-2xl backdrop-blur-xl transition-all focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/30 sm:py-4 sm:pl-12 sm:pr-32 sm:text-base">

                                <button type="submit"
                                    class="absolute right-1.5 top-1/2 -translate-y-1/2 transform rounded-full bg-orange-500 px-4 py-2 text-xs font-bold text-white shadow-lg shadow-orange-500/30 transition-all hover:scale-105 hover:bg-orange-600 active:scale-95 sm:right-2 sm:px-6 sm:py-2.5 sm:text-sm">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="reveal delay-400 flex flex-wrap items-center gap-2">
                        <span class="text-xs text-slate-400">Trending:</span>
                        <a href="{{ route('search') }}?q=AI" class="rounded-full bg-white/10 px-2.5 py-1 text-xs text-white transition-colors hover:bg-white/20 sm:px-3 sm:text-sm">AI & Pendidikan</a>
                        <a href="{{ route('search') }}?q=Sains" class="rounded-full bg-white/10 px-2.5 py-1 text-xs text-white transition-colors hover:bg-white/20 sm:px-3 sm:text-sm">Sains Data</a>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <!-- Latest Articles Row List Section -->
    <section class="mx-auto max-w-[90vw] px-6 py-12 sm:py-16 lg:px-8">
        <div class="reveal mb-8 flex flex-col justify-between gap-4 border-b border-slate-200/80 pb-6 sm:flex-row sm:items-end">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-orange-600">Publikasi Terbaru</span>
                <h2 class="font-heading mt-1 text-2xl font-extrabold text-slate-950 sm:text-4xl">
                    Artikel & Riset Terpilih
                </h2>
            </div>
            <a href="{{ route('search') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-950 transition-colors hover:text-orange-600">
                <span>Lihat Semua Artikel</span>
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        <div class="flex flex-col space-y-4">
            @forelse ($articles as $index => $article)
                <div class="reveal delay-{{ ($index + 1) * 100 }}">
                    <x-article-card 
                        :title="$article->title"
                        :abstract="$article->abstract"
                        :category="$article->category"
                        :date="$article->published_date ? $article->published_date->translatedFormat('j M Y') : ''"
                        :authors="$article->authors"
                        :slug="$article->slug"
                    />
                </div>
            @empty
                <div class="p-8 text-center text-slate-500 bg-white/50 rounded-2xl border border-slate-100">
                    Belum ada artikel yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </section>

</x-app-layout>
