<x-app-layout>
    <x-slot name="title">Eksplorasi & Pencarian Artikel - Cahaya Ilmu Bangsa</x-slot>
    <x-slot name="description">Cari naskah, jurnal, opini, dan artikel ilmiah Cahaya Ilmu Bangsa berdasarkan kata kunci atau kategori.</x-slot>

    <!-- Search Header Section with Warm Parchment Glass overlay -->
    <section class="relative bg-center bg-no-repeat bg-cover py-16 lg:py-20" style="background-image: linear-gradient(to bottom, rgba(255, 248, 222, 0.85), rgba(255, 248, 222, 0.95)), url('{{ asset('assets/images/background.png') }}');">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 mt-12 sm:mt-16">
            <h1 class="text-3xl sm:text-5xl font-extrabold font-heading text-slate-900">
                Pencarian & Eksplorasi Riset
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 max-w-xl mx-auto font-medium">
                Temukan ribuan ulasan, naskah ilmiah, dan artikel bertema pendidikan, sains, serta kebudayaan.
            </p>

            <!-- Prominent Glass Search Form -->
            <form action="{{ route('search') }}" method="GET" class="relative max-w-2xl mx-auto">
                <div class="relative flex items-center">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}"
                           placeholder="Ketik kata kunci pencarian (misal: 'Pendidikan', 'Literasi', 'AI')..." 
                           required
                           class="w-full pl-12 pr-28 py-3.5 text-sm bg-white/80 backdrop-blur-2xl text-slate-900 rounded-full shadow-xl shadow-slate-900/5 focus:outline-none focus:ring-4 focus:ring-orange-500/20 border border-white/90 transition-all placeholder:text-slate-400">
                    
                    <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>

                    <button type="submit" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 px-5 py-2 text-xs font-bold text-white bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 rounded-full transition-colors shadow-sm">
                        Cari
                    </button>
                </div>
            </form>

            <!-- Active Category Glass Filters -->
            <div class="flex flex-wrap items-center justify-center gap-2 pt-2 text-xs">
                <span class="text-slate-500 font-medium">Filter cepat:</span>
                @foreach(['Semua', 'Pendidikan', 'Sains & Teknologi', 'Kebudayaan', 'Ekonomi'] as $filter)
                    @php $isActive = request('category') === $filter || (!request('category') && $filter === 'Semua'); @endphp
                    <a href="{{ route('search') }}{{ $filter !== 'Semua' ? '?category='.urlencode($filter) : '' }}" 
                       class="px-3.5 py-1.5 rounded-full border transition-all font-medium {{ $isActive ? 'bg-orange-500 text-white font-bold border-orange-500 shadow-md shadow-orange-500/20' : 'bg-white/75 backdrop-blur-md text-slate-700 border-white/80 hover:bg-white hover:text-orange-600 shadow-xs' }}">
                        {{ $filter }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Search Results Row List Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Results Info Header -->
        <div class="flex items-center justify-between pb-6 mb-8 border-b border-orange-950/10">
            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    @if(request('q'))
                        Hasil pencarian untuk: <span class="text-orange-600 font-heading">"{{ request('q') }}"</span>
                    @elseif(request('category'))
                        Kategori: <span class="text-orange-600 font-heading">"{{ request('category') }}"</span>
                    @else
                        Semua Artikel Terbaru
                    @endif
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Menampilkan hasil relevan berdasarkan indeks terbaru.
                </p>
            </div>

            <!-- Sort Option Dropdown -->
            <div class="flex items-center gap-2 text-xs text-slate-500">
                <label for="sort" class="hidden sm:inline">Urutkan:</label>
                <select id="sort" class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-orange-500">
                    <option value="newest">Terbaru</option>
                    <option value="popular">Popularitas</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>
        </div>

        <!-- Articles Row List -->
        <div class="flex flex-col space-y-4">
            <x-article-card 
                title="Transformasi Kurikulum Digital dalam Mengakselerasi Mutu Pendidikan"
                excerpt="Tinjauan komprehensif penerapan kurikulum berbasis teknologi dan pemerataan infrastruktur sekolah."
                category="Pendidikan"
                date="5 Ags 2026"
                readTime="7 min baca"
                author="Tim Redaksi CIB"
                slug="transformasi-kurikulum-digital"
            />

            <x-article-card 
                title="Pentingnya Penguatan Literasi Digital Pada Generasi Z di Era GenAI"
                excerpt="Perkembangan AI generatif menuntut fondasi kritis sejak dini agar generasi muda menjadi produsen pengetahuan."
                category="Sains & Teknologi"
                date="4 Ags 2026"
                readTime="6 min baca"
                author="Dr. Ahmad Subagyo"
                slug="literasi-digital-gen-z"
            />

            <x-article-card 
                title="Strategi Penerbitan Akademik Berstandar Internasional Bagi Peneliti Muda"
                excerpt="Langkah praktis menyusun naskah ilmiah, memilih jurnal bereputasi, dan menghindari perangkap jurnal predator."
                category="Pendidikan"
                date="3 Ags 2026"
                readTime="8 min baca"
                author="Prof. Dewi Lestari"
                slug="strategi-penerbitan-akademik"
            />

            <x-article-card 
                title="Menjaga Keberagaman Budaya Lokal Melalui Digitalisasi Naskah Kuno"
                excerpt="Upaya penyelamatan naskah Nusantara melalui teknik pemindaian tinggi dan pengarsipan digital berbasis sains."
                category="Kebudayaan"
                date="1 Ags 2026"
                readTime="4 min baca"
                author="Budi Santoso, M.Hum"
                slug="digitalisasi-naskah-kuno"
            />
        </div>

        <!-- Pagination Placeholder -->
        <div class="mt-12 flex items-center justify-center gap-2">
            <button disabled class="px-3.5 py-1.5 rounded-lg border border-slate-300 text-xs text-slate-400 opacity-50 cursor-not-allowed">
                &laquo; Sebelumnya
            </button>
            <span class="px-3.5 py-1.5 rounded-lg bg-orange-600 text-white font-bold text-xs">1</span>
            <button class="px-3.5 py-1.5 rounded-lg border border-slate-300 text-xs text-slate-700 hover:bg-white/80">2</button>
            <button class="px-3.5 py-1.5 rounded-lg border border-slate-300 text-xs text-slate-700 hover:bg-white/80">
                Berikutnya &raquo;
            </button>
        </div>
    </section>
</x-app-layout>
