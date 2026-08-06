<x-app-layout>
    <x-slot name="title">Eksplorasi & Pencarian Artikel - Cahaya Ilmu Bangsa</x-slot>
    <x-slot name="description">Cari naskah, jurnal, opini, dan artikel ilmiah Cahaya Ilmu Bangsa berdasarkan kata kunci atau kategori.</x-slot>

    <!-- Search Header Section with Warm Parchment Glass overlay -->
    <section class="relative bg-cover bg-center bg-no-repeat py-16 lg:py-20"
        style="background-image: linear-gradient(to bottom, rgba(255, 248, 222, 0.85), rgba(255, 248, 222, 0.95)), url('{{ asset('assets/images/background.png') }}');">
        <div class="mx-auto mt-12 max-w-4xl space-y-6 px-4 text-center sm:mt-16 sm:px-6 lg:px-8">
            <h1 class="font-heading text-3xl font-extrabold text-slate-900 sm:text-5xl">
                Pencarian & Eksplorasi Riset
            </h1>
            <p class="mx-auto max-w-xl text-xs font-medium text-slate-600 sm:text-sm">
                Temukan ribuan ulasan, naskah ilmiah, dan artikel bertema pendidikan, sains, serta kebudayaan.
            </p>

            <!-- Prominent Glass Search Form -->
            <form action="{{ route('search') }}" method="GET" class="relative mx-auto max-w-2xl">
                <div class="relative flex items-center">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci pencarian (misal: 'Pendidikan', 'Literasi', 'AI')..." required
                        class="w-full rounded-full border border-white/90 bg-white/80 py-3.5 pl-12 pr-28 text-sm text-slate-900 shadow-xl shadow-slate-900/5 backdrop-blur-2xl transition-all placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-orange-500/20">

                    <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>

                    <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-gradient-to-r from-orange-500 to-amber-500 px-5 py-2 text-xs font-bold text-white shadow-sm transition-colors hover:from-orange-600 hover:to-amber-600">
                        Cari
                    </button>
                </div>
            </form>

            <!-- Active Category Glass Filters -->
            <div class="flex flex-wrap items-center justify-center gap-2 pt-2 text-xs">
                <span class="font-medium text-slate-500">Filter cepat:</span>
                @foreach (['Semua', 'Pendidikan', 'Sains & Teknologi', 'Kebudayaan', 'Ekonomi'] as $filter)
                    @php $isActive = request('category') === $filter || (!request('category') && $filter === 'Semua'); @endphp
                    <a href="{{ route('search') }}{{ $filter !== 'Semua' ? '?category=' . urlencode($filter) : '' }}"
                        class="{{ $isActive ? 'bg-orange-500 text-white font-bold border-orange-500 shadow-md shadow-orange-500/20' : 'bg-white/75 backdrop-blur-md text-slate-700 border-white/80 hover:bg-white hover:text-orange-600 shadow-xs' }} rounded-full border px-3.5 py-1.5 font-medium transition-all">
                        {{ $filter }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

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
            <x-article-card title="Transformasi Kurikulum Digital dalam Mengakselerasi Mutu Pendidikan"
                abstract="Tinjauan komprehensif penerapan kurikulum berbasis teknologi dan pemerataan infrastruktur sekolah." category="Pendidikan" date="5 Ags 2026"
                authors="Tim Redaksi CIB" slug="transformasi-kurikulum-digital" />

            <x-article-card title="Pentingnya Penguatan Literasi Digital Pada Generasi Z di Era GenAI"
                abstract="Perkembangan AI generatif menuntut fondasi kritis sejak dini agar generasi muda menjadi produsen pengetahuan." category="Sains & Teknologi" date="4 Ags 2026"
                authors="Dr. Ahmad Subagyo" slug="literasi-digital-gen-z" />

            <x-article-card title="Strategi Penerbitan Akademik Berstandar Internasional Bagi Peneliti Muda"
                abstract="Langkah praktis menyusun naskah ilmiah, memilih jurnal bereputasi, dan menghindari perangkap jurnal predator." category="Pendidikan" date="3 Ags 2026"
                authors="Prof. Dewi Lestari" slug="strategi-penerbitan-akademik" />

            <x-article-card title="Menjaga Keberagaman Budaya Lokal Melalui Digitalisasi Naskah Kuno"
                abstract="Upaya penyelamatan naskah Nusantara melalui teknik pemindaian tinggi dan pengarsipan digital berbasis sains." category="Kebudayaan" date="1 Ags 2026"
                authors="Budi Santoso, M.Hum" slug="digitalisasi-naskah-kuno" />
        </div>

        <!-- Pagination Placeholder -->
        <div class="mt-12 flex items-center justify-center gap-2">
            <button disabled class="cursor-not-allowed rounded-lg border border-slate-300 px-3.5 py-1.5 text-xs text-slate-400 opacity-50">
                &laquo; Sebelumnya
            </button>
            <span class="rounded-lg bg-orange-600 px-3.5 py-1.5 text-xs font-bold text-white">1</span>
            <button class="rounded-lg border border-slate-300 px-3.5 py-1.5 text-xs text-slate-700 hover:bg-white/80">2</button>
            <button class="rounded-lg border border-slate-300 px-3.5 py-1.5 text-xs text-slate-700 hover:bg-white/80">
                Berikutnya &raquo;
            </button>
        </div>
    </section>
</x-app-layout>
