@php
    $article = [
        'title' => 'PENGARUH KUALITAS LAYANAN, PROMOSI DAN LOKASI TERHADAP KEPUTUSAN ORANG TUA MEMILIH BIMBA AIUEO RAWALUMBU BEKASI',
        'category' => 'Manajemen Pendidikan & Bisnis',
        'authors' => ['Syerliananda Oktavia', 'Indra Muis'],
        'journal' => 'Jurnal Musytari',
        'publisher' => 'Cahaya Ilmu Bangsa (CIB)',
        'doi' => '10.5281/zenodo.21792143',
        'doi_url' => 'https://doi.org/10.5281/zenodo.21792143',
        'pdf_url' => 'https://zenodo.org/records/21792143/files/pdf-3.pdf?download=1',
        'pdf_preview_url' =>
            'https://journal.cib.institute/plugins/generic/pdfJsViewer/pdf.js/web/viewer.html?file=https%3A%2F%2Fjournal.cib.institute%2Findex.php%2Fmusytari%2Farticle%2Fdownload%2F2661%2F2557%2F2763',
        'journal_url' => 'https://journal.cib.institute/index.php/musytari/article/view/2661',
        'license' => 'Open Access (CC BY 4.0)',
        'date_formatted' => '5 Agustus 2026',
        'date' => '2026/08/05',
        'year' => '2026',
        'volume' => '3',
        'issue' => '1',
        'language' => 'id',
        'language_name' => 'Indonesia (id)',
        'indexing' => ['OpenAIRE', 'Zenodo', 'Google Scholar'],
        'keywords' => 'biMBA; Kualitas Layanan; Promosi; Lokasi; Keputusan Orang Tua',
        'tags' => ['#biMBA', '#KualitasLayanan', '#Promosi', '#Lokasi', '#KeputusanOrangTua'],
        'abstract' =>
            'The background of this study stems from the increasingly competitive landscape among early childhood education institutions. This situation pushes each institution to better understand what factors parents actually consider when choosing a place for their children to learn. This research specifically aims to examine how much service quality, promotion, and location influence parents\' decisions in choosing biMBA AIUEO Rawalumbu. A quantitative approach was adopted, collecting data through questionnaires distributed to 85 respondents. Sampling was carried out using a non-probability sampling method with a saturated sampling technique. The collected data was then analyzed through a series of statistical tests, including validity tests, reliability tests, classical assumption tests, and multiple linear regression analysis. The findings revealed that service quality actually had a negative and insignificant effect on parents\' decisions. In contrast, promotion proved to have a positive and significant influence. As for location, while it showed a positive effect, it was not strong enough to be considered statistically significant. However, when all three variables were tested simultaneously, the results indicated a significant combined influence on parents\' decision-making. These findings carry an important message for biMBA AIUEO Rawalumbu: promotional strategies need to be continuously strengthened, as promotion emerged as the most dominant factor in attracting parents\' interest. At the same time, service quality still deserves serious attention, so it does not become a weak point that ultimately undermines the institution\'s appeal in the eyes of prospective students\' families.',
    ];

    $authorsString = is_array($article['authors']) ? implode('; ', $article['authors']) : $article['authors'];
    $citationAuthors = is_array($article['authors'])
        ? implode(
            ' & ',
            array_map(function ($a) {
                $parts = explode(' ', trim($a));
                $lastName = array_pop($parts);
                $firstInit = count($parts) > 0 ? mb_substr($parts[0], 0, 1) . '.' : '';
                return $lastName . ', ' . $firstInit;
            }, $article['authors']),
        )
        : $article['authors'];
    $apaCitation = "{$citationAuthors} ({$article['year']}). {$article['title']}. {$article['journal']}. {$article['doi_url']}";
@endphp

<x-app-layout>
    <x-slot name="title">{{ $article['title'] }} - Cahaya Ilmu Bangsa</x-slot>

    <x-slot name="meta">
        <!-- Google Scholar / Highwire Scholarly Meta Tags -->
        <meta name="citation_title" content="{{ $article['title'] }}">
        @foreach ((array) $article['authors'] as $author)
            <meta name="citation_author" content="{{ $author }}">
        @endforeach
        <meta name="citation_publication_date" content="{{ $article['date'] }}">
        <meta name="citation_journal_title" content="{{ $article['journal'] }}">
        <meta name="citation_publisher" content="{{ $article['publisher'] }}">
        <meta name="citation_volume" content="{{ $article['volume'] }}">
        <meta name="citation_issue" content="{{ $article['issue'] }}">
        <meta name="citation_doi" content="{{ $article['doi'] }}">
        <meta name="citation_pdf_url" content="{{ $article['pdf_url'] }}">
        <meta name="citation_abstract_html_url" content="{{ request()->url() }}">
        <meta name="citation_fulltext_html_url" content="{{ request()->url() }}">
        <meta name="citation_language" content="{{ $article['language'] }}">
        <meta name="citation_keywords" content="{{ $article['keywords'] }}">

        <!-- Dublin Core Metadata Standard (Academic Indexing) -->
        <meta name="DC.title" content="{{ $article['title'] }}">
        @foreach ((array) $article['authors'] as $author)
            <meta name="DC.creator" content="{{ $author }}">
        @endforeach
        <meta name="DC.issued" content="{{ $article['date'] }}">
        <meta name="DC.publisher" content="{{ $article['publisher'] }}">
        <meta name="DC.identifier" content="{{ $article['doi'] }}">
        <meta name="DC.language" content="{{ $article['language'] }}">

        <!-- Open Graph / Social Media Meta Tags -->
        <meta property="og:title" content="{{ $article['title'] }}">
        <meta property="og:description" content="{{ $article['abstract'] }}">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ request()->url() }}">
    </x-slot>

    <!-- Article Header & Breadcrumbs Section -->
    <header class="border-b border-slate-200 bg-gradient-to-b from-slate-100 via-slate-50 to-slate-50 py-12 text-slate-900 lg:py-16">
        <div class="mx-auto max-w-[90vw] space-y-6 px-4 sm:px-6 lg:px-8">

            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="transition-colors hover:text-orange-600">Beranda</a>
                <span>/</span>
                <a href="{{ route('search') }}?category=Pendidikan" class="transition-colors hover:text-orange-600">{{ $article['category'] }}</a>
                <span>/</span>
                <span class="truncate font-medium text-slate-800">{{ $article['title'] }}</span>
            </nav>

            <!-- Category Badge & DOI Badge -->
            <div class="flex flex-wrap items-center gap-3">
                <span class="shadow-xs inline-flex items-center rounded-full border border-orange-200 bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                    {{ $article['category'] }}
                </span>
                <a href="{{ $article['doi_url'] }}" target="_blank" rel="noopener noreferrer"
                    class="shadow-xs inline-flex items-center gap-1.5 rounded-full border border-slate-700 bg-slate-900 px-3 py-1 font-mono text-xs font-semibold text-slate-100 transition-colors hover:bg-orange-600">
                    <span>DOI: {{ $article['doi'] }}</span>
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>

            <!-- Title -->
            <h1 class="font-heading text-2xl font-extrabold leading-[1.2] tracking-tight text-slate-900 sm:text-3xl lg:text-4xl">
                {{ $article['title'] }}
            </h1>

            <!-- Author & Article Metadata Card -->
            <div class="flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 pt-4">
                <div class="flex items-center gap-3">
                    <div class="text-sm font-bold text-slate-900">{{ $authorsString }}</div>
                </div>

                <div class="flex items-center gap-4 text-xs text-slate-500">
                    <div class="flex items-center gap-2">
                        <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan artikel berhasil disalin!');"
                            class="flex items-center gap-1.5 rounded-lg border border-orange-200 bg-orange-50 px-4 py-2 text-xs font-semibold text-orange-600 transition-colors hover:bg-orange-100">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Bagikan Artikel</span>
                        </button>
                        <span>&bull;</span>
                        <a href="{{ $article['pdf_url'] }}" target="_blank" class="inline-flex items-center gap-1 font-semibold text-orange-600 hover:underline">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span>Unduh PDF</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- Main Article Body with Side Section Layout -->
    <article class="mx-auto max-w-[90vw] px-4 py-12 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">

            <!-- Left Main Content Column (Abstract + PDF Preview) -->
            <div class="space-y-8 lg:col-span-8">

                <!-- Abstract Section -->
                <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-slate-50 p-6 shadow-sm sm:p-8">
                    <h2 class="font-heading flex items-center gap-2 border-b border-slate-200 pb-3 text-xl font-bold text-slate-900 sm:text-2xl">
                        <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Abstrak / Abstract</span>
                    </h2>
                    <p class="text-sm font-normal italic leading-relaxed text-slate-700 sm:text-base">
                        {{ $article['abstract'] }}
                    </p>
                </div>

                <!-- Tags & Share Action Bar -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex flex-wrap items-center gap-2 text-xs">
                        <span class="font-bold text-slate-600">Tag:</span>
                        @foreach ($article['tags'] as $tag)
                            <span class="rounded-full border border-slate-200 bg-slate-100 px-3 py-1 text-slate-700">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>


                <!-- PDF Preview Section -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 shadow-xl">
                    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-800 bg-slate-900 px-5 py-4 text-white">
                        <div class="font-heading flex items-center gap-2 text-sm font-bold text-slate-100">
                            <svg class="h-5 w-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            <span>Dokumen PDF</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs">
                            <a href="{{ $article['pdf_url'] }}" target="_blank"
                                class="flex items-center gap-1.5 rounded-lg bg-orange-600 px-3.5 py-1.5 font-bold text-white shadow-sm transition-all hover:bg-orange-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                <span>Unduh PDF</span>
                            </a>
                        </div>
                    </div>

                    <div class="relative h-[650px] w-full bg-slate-800 sm:h-[800px]">
                        <iframe src="{{ $article['pdf_preview_url'] }}" class="h-full w-full border-0" title="PDF Document Preview" allowfullscreen>
                            <p class="p-6 text-center text-white">Browser Anda tidak mendukung iframe preview. <a href="{{ $article['pdf_url'] }}" class="text-orange-400 underline">Klik di sini
                                    untuk mengunduh PDF</a>.</p>
                        </iframe>
                    </div>
                </div>


            </div>

            <!-- Right Side Section (Sidebar Column) -->
            <aside class="space-y-6 lg:col-span-4">

                <!-- Quick Download & Action Card -->
                <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
                    <h3 class="font-heading flex items-center gap-2 border-b border-slate-100 pb-3 text-lg font-bold text-slate-900">
                        <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Akses Dokumen</span>
                    </h3>

                    <div class="space-y-3">
                        <a href="{{ $article['pdf_url'] }}" target="_blank"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-orange-600 px-4 py-3 text-sm font-bold text-white shadow-md transition-all hover:bg-orange-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            <span>Unduh PDF Naskah Lengkap</span>
                        </a>

                        <a href="{{ $article['journal_url'] }}" target="_blank" rel="noopener noreferrer"
                            class="flex w-full items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 transition-all hover:bg-slate-100">
                            <span>{{ $article['journal'] }} (CIB)</span>
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                        
                    </div>
                </div>

                <!-- Publication Information Card -->
                <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-white p-6 text-sm shadow-sm">
                    <h3 class="font-heading flex items-center gap-2 border-b border-slate-100 pb-3 text-lg font-bold text-slate-900">
                        <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Detail Informasi Metadata</span>
                    </h3>

                    <div class="space-y-3.5 divide-y divide-slate-100">
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Penulis:</span>
                            <span class="font-bold text-slate-900">{{ $authorsString }}</span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Jurnal / Penerbit:</span>
                            <span class="font-semibold text-slate-800">{{ $article['journal'] }} &bull; {{ $article['publisher'] }}</span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Volume & Terbitan:</span>
                            <span class="font-semibold text-slate-800">Vol. {{ $article['volume'] }} No. {{ $article['issue'] }} ({{ $article['year'] }})</span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Tanggal Publikasi:</span>
                            <span class="font-semibold text-slate-800">{{ $article['date_formatted'] }}</span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Kategori Bidang:</span>
                            <span class="font-semibold text-slate-800">{{ $article['category'] }}</span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Bahasa:</span>
                            <span class="font-semibold text-slate-800">{{ $article['language_name'] }}</span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Digital Object Identifier (DOI):</span>
                            <a href="{{ $article['doi_url'] }}" target="_blank" class="break-all font-mono font-bold text-orange-600 hover:underline">{{ $article['doi'] }}</a>
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Lisensi Akses:</span>
                            <span class="mt-1 inline-block rounded border border-slate-200 bg-slate-100 px-2.5 py-1 font-semibold text-slate-700">
                                {{ $article['license'] }}
                            </span>
                        </div>
                        <div class="pt-2">
                            <span class="mb-1 block text-slate-500">Terindeks Di:</span>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach ($article['indexing'] as $indexItem)
                                    <span class="inline-block rounded border border-slate-200 bg-slate-100 px-2.5 py-0.5 text-xs font-bold text-slate-600">{{ $indexItem }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Citation Card -->
                <div class="space-y-3 rounded-2xl border border-slate-200/80 bg-white p-6 text-sm shadow-sm">
                    <h3 class="font-heading flex items-center gap-2 border-b border-slate-100 pb-3 text-lg font-bold text-slate-900">
                        <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                        <span>Sitasi (APA Format)</span>
                    </h3>

                    <div class="select-all rounded-xl border border-slate-200 bg-slate-50 p-4 font-mono text-xs leading-relaxed text-slate-700">
                        {{ $apaCitation }}
                    </div>
                </div>

                <!-- Related Articles Side Card -->
                <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
                    <h3 class="font-heading flex items-center gap-2 border-b border-slate-100 pb-3 text-lg font-bold text-slate-900">
                        <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <span>Artikel Terkait</span>
                    </h3>

                    <div class="space-y-4 divide-y divide-slate-100">
                        <div class="space-y-1 pt-1">
                            <span class="text-xs font-bold uppercase text-orange-600">Sains & Teknologi</span>
                            <h4 class="text-sm font-bold leading-snug text-slate-900 hover:text-orange-600">
                                <a href="{{ route('article.show', ['slug' => 'literasi-digital-gen-z']) }}">Pentingnya Penguatan Literasi Digital Pada Generasi Z di Era GenAI</a>
                            </h4>
                            <p class="text-xs text-slate-500">Dr. Ahmad Subagyo</p>
                        </div>

                        <div class="space-y-1 pt-3">
                            <span class="text-xs font-bold uppercase text-orange-600">Pendidikan</span>
                            <h4 class="text-sm font-bold leading-snug text-slate-900 hover:text-orange-600">
                                <a href="{{ route('article.show', ['slug' => 'strategi-penerbitan-akademik']) }}">Strategi Penerbitan Akademik Berstandar Internasional</a>
                            </h4>
                            <p class="text-xs text-slate-500">Prof. Dewi Lestari</p>
                        </div>
                    </div>
                </div>

            </aside>

        </div>



    </article>

</x-app-layout>
