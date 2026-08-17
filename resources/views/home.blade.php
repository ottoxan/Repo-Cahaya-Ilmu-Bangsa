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

                    <img class="w-2xl" src="{{ asset('assets/images/logo-white.svg') }}" alt="Logo CIB">

                    <p class="reveal max-w-2xl text-sm font-light leading-relaxed text-slate-300 delay-300 sm:text-base lg:text-lg">
                        Jelajahi naskah ilmiah, ulasan akademis, dan jurnal terakreditasi. Didesain untuk para peneliti yang percaya setiap wawasan harus dapat diakses bebas.
                    </p>

                    <!-- Search Input inside Hero Card -->
                    <div class="reveal delay-400 max-w-2xl pt-4">
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <div class="relative flex items-center">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>

                                <input type="text" name="q" placeholder="Cari artikel, penulis, naskah, DOI..." required
                                    class="w-full rounded-full border border-white/20 bg-white/10 py-4 pl-12 pr-32 text-sm text-white placeholder-slate-400 shadow-2xl backdrop-blur-xl transition-all focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-500/30 sm:text-base">

                                <button type="submit"
                                    class="absolute right-2 top-1/2 -translate-y-1/2 transform rounded-full bg-orange-500 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-orange-500/30 transition-all hover:scale-105 hover:bg-orange-600 active:scale-95">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="reveal delay-400 flex items-center gap-2">
                        <span class="text-xs text-slate-400">Trending:</span>
                        <a href="{{ route('search') }}?q=AI" class="rounded-full bg-white/10 px-3 py-1 text-white transition-colors hover:bg-white/20">AI & Pendidikan</a>
                        <a href="{{ route('search') }}?q=Sains" class="rounded-full bg-white/10 px-3 py-1 text-white transition-colors hover:bg-white/20">Sains Data</a>
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
            <div class="reveal delay-100">
                <x-article-card title="Transformasi Kurikulum Digital dalam Mengakselerasi Mutu Pendidikan Indonesia"
                    abstract="Sebuah tinjauan komprehensif mengenai penerapan kurikulum berbasis teknologi dan tantangan pemerataan infrastruktur sekolah." category="Pendidikan" date="5 Ags 2026"
                    authors="Dr. Raden Haryo" slug="transformasi-kurikulum-digital" />
            </div>

            <div class="reveal delay-200">
                <x-article-card title="Pentingnya Penguatan Literasi Digital Pada Generasi Z di Era GenAI"
                    abstract="Perkembangan AI generatif menuntut fondasi kritis sejak dini agar generasi muda menjadi produsen pengetahuan." category="Sains & Teknologi" date="4 Ags 2026"
                    authors="Dr. Ahmad Subagyo" slug="literasi-digital-gen-z" />
            </div>

            <div class="reveal delay-300">
                <x-article-card title="Strategi Penerbitan Akademik Berstandar Internasional Bagi Peneliti Muda"
                    abstract="Langkah praktis menyusun naskah ilmiah, memilih jurnal bereputasi, dan menghindari perangkap jurnal predator." category="Pendidikan" date="3 Ags 2026"
                    authors="Prof. Dewi Lestari" slug="strategi-penerbitan-akademik" />
            </div>

            <div class="reveal delay-400">
                <x-article-card title="Menjaga Keberagaman Budaya Lokal Melalui Digitalisasi Naskah Kuno"
                    abstract="Upaya penyelamatan naskah Nusantara melalui teknik pemindaian tinggi dan pengarsipan digital berbasis sains." category="Kebudayaan" date="1 Ags 2026"
                    authors="Budi Santoso, M.Hum" slug="digitalisasi-naskah-kuno" />
            </div>
        </div>
    </section>

</x-app-layout>
