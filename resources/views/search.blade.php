<x-app-layout>
    <x-slot name="title">Eksplorasi & Pencarian Artikel - Cahaya Ilmu Bangsa</x-slot>
    <x-slot name="description">Cari naskah, jurnal, opini, dan artikel ilmiah Cahaya Ilmu Bangsa berdasarkan kata kunci atau kategori.</x-slot>

    <!-- Search Header Section with Warm Parchment Glass overlay -->
    <div class="px-4 pb-8 pt-4 sm:px-6 lg:px-8">
        <section class="relative flex min-h-[50vh] items-center justify-center overflow-hidden rounded-[28px] bg-slate-950 bg-cover bg-center text-white"
            style="background-image: linear-gradient(to bottom, rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.92)), url('{{ asset('assets/images/background.png') }}');">
            <div class="mx-auto mt-12 max-w-4xl space-y-6 px-4 text-center sm:mt-16 sm:px-6 lg:px-8">
                <h1 class="font-heading text-3xl font-extrabold sm:text-5xl">
                    Pencarian & Eksplorasi Riset
                </h1>
                <p class="mx-auto max-w-xl text-xs font-medium sm:text-sm">
                    Temukan ribuan ulasan, naskah ilmiah, dan artikel bertema pendidikan, sains, serta kebudayaan.
                </p>

                <!-- Prominent Glass Search Form -->
                <form action="{{ route('search') }}" method="GET" class="relative mx-auto max-w-2xl">
                    <div class="relative flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci pencarian (misal: 'Pendidikan', 'Literasi', 'AI')..." required
                            class="w-full rounded-full border border-white/20 bg-white/10 py-4 pl-12 pr-32 text-sm text-white placeholder-slate-400 shadow-2xl backdrop-blur-xl transition-all focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/30 sm:text-base">

                        <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>

                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 transform rounded-full bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-orange-500/30 transition-all hover:scale-105 hover:bg-orange-600 active:scale-95">
                            Cari
                        </button>
                    </div>
                </form>

                <!-- Active Category Glass Filters -->
                <div class="flex flex-wrap items-center justify-center gap-2 pt-2">
                    <span class="text-slate-400">Filter cepat:</span>
                    @foreach (['Semua', 'Pendidikan', 'Sains & Teknologi', 'Kebudayaan', 'Ekonomi'] as $filter)
                        @php $isActive = request('category') === $filter || (!request('category') && $filter === 'Semua'); @endphp
                        <a href="{{ route('search') }}{{ $filter !== 'Semua' ? '?category=' . urlencode($filter) : '' }}"
                            class="{{ $isActive ? 'bg-orange-500 text-white font-bold' : 'bg-white/10 text-white hover:bg-white/20' }} rounded-full px-3 py-1 transition-colors">
                            {{ $filter }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    <!-- Search Results Row List Section -->
    <section class="mx-auto max-w-[90vw] px-4 py-12 sm:px-6 lg:px-8">
        <!-- Results Info Header -->
        <div class="mb-8 flex items-center justify-between border-b border-orange-950/10 pb-6">
            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    @if (request('q'))
                        Hasil pencarian untuk: <span class="font-heading text-orange-600">"{{ request('q') }}"</span>
                    @elseif(request('category'))
                        Kategori: <span class="font-heading text-orange-600">"{{ request('category') }}"</span>
                    @else
                        Semua Artikel Terbaru
                    @endif
                </h2>
                <p class="mt-1 text-xs text-slate-500">
                    Menampilkan hasil relevan berdasarkan indeks terbaru.
                </p>
            </div>

            <!-- Sort Option Dropdown -->
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <label for="sort" class="hidden sm:inline">Urutkan:</label>
                <select id="sort" class="rounded-lg border border-slate-200 bg-white/80 px-3 py-1.5 text-xs text-slate-700 backdrop-blur-md focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="newest">Terbaru</option>
                    <option value="popular">Popularitas</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>
        </div>

        <!-- Articles Row List -->
        <div class="flex flex-col space-y-4">
            @forelse ($articles as $index => $article)
                <x-article-card 
                    :title="$article->title"
                    :abstract="$article->abstract"
                    :category="$article->category"
                    :date="$article->published_date ? $article->published_date->translatedFormat('j M Y') : ''"
                    :authors="$article->authors"
                    :slug="$article->slug"
                />
            @empty
                <div class="p-8 text-center text-slate-500 bg-white/50 rounded-2xl border border-slate-100">
                    Tidak ditemukan artikel yang sesuai dengan kriteria pencarian.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex items-center justify-center">
            {{ $articles->links() }}
        </div>
    </section>
</x-app-layout>
