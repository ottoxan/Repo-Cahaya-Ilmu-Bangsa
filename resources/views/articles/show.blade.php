@php
if (!isset($article)) {
    $article = [
        'title' => 'PENGARUH KUALITAS LAYANAN, PROMOSI DAN LOKASI TERHADAP KEPUTUSAN ORANG TUA MEMILIH BIMBA AIUEO RAWALUMBU BEKASI',
        'category' => 'Manajemen Pendidikan & Bisnis',
        'authors' => ['Syerliananda Oktavia', 'Indra Muis'],
        'author_institution' => 'Universitas Islam 45 Bekasi',
        'author_institutions' => [
            'Syerliananda Oktavia' => 'Universitas Islam 45 Bekasi',
            'Indra Muis' => 'Universitas Islam 45 Bekasi',
        ],
        'journal_id' => 7,
        'journal' => 'Musytari: Jurnal Manajemen, Akuntansi, dan Ekonomi',
        'publisher' => 'Cahaya Ilmu Bangsa (CIB)',
        'doi' => '10.5281/zenodo.21792143',
        'doi_url' => 'https://doi.org/10.5281/zenodo.21792143',
        'pdf_url' =>
            'https://journal.cib.institute/plugins/generic/pdfJsViewer/pdf.js/web/viewer.html?file=https%3A%2F%2Fjournal.cib.institute%2Findex.php%2Fmusytari%2Farticle%2Fdownload%2F2661%2F2557%2F2763',
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
        'references' =>
            "Cruse, A. (2000). Meaning in Language: An Introduction to Semantics and Pragmatics. Oxford University Press. https://doi.org/10.1515/9783110226614.74\nHurford R., J., Heasley, B., & Smith B., M. (2007). Semantics: A Coursebook. Cambridge University Press.\nIstama, N. R., Al-Anwar, S. F., & Aidil Syah Putra. (2024). Semantic Analysis of Metaphors of Selected James Arthur'S Song. English Teaching Journal and Research: Journal of English Education, Literature, And Linguistics, 4(2), 32–46. https://doi.org/10.55148/etjar.v4i2.1139\nKendong, F. A., Daud, A. S., Joharry, S. A., & Mcgraw, T. (2023). A Corpus- driven Analysis of Taylor Swift ' s Song Lyrics Taylor Swift ' s song lyrics as a specialised corpus Teardrops on My Guitar. International Journal of Modern Languages and Applied Linguistics, 7(2), 59–82. https://ir.uitm.edu.my/id/eprint/83439\nLakoff, G., & Johnson, M. (2003). Metaphors We Live By.pdf (p. 129).\nLeech, G. (1981). Semantics: The Study of Meaning Second edition - revised and updated. 388.\nLyons, J. (1977). Semantics 1. Cambridge University Press.\nNilsen, D. L. F., & Palmer, F. R. (1976). Semantics: Second edition. In The Modern Language Journal (Vol. 60, Issue 7, p. 414). https://doi.org/10.2307/324444\nSandelowski, M. (2000). Focus on research methods: Whatever happened to qualitative description? Research in Nursing and Health, 23(4), 334–340. https://doi.org/10.1002/1098-240x(200008)23:4<334::aid-nur9>3.0.co;2-g\nWierzbicka, A. (1990). The meaning of color terms: Semantics, culture, and cognition. Cognitive Linguistics, 1(1), 99–150. https://doi.org/10.1515/cogl.1990.1.1.99",
    ];
}

    // Fetch Journal model dynamically based on journal_id
    $journalModel = !empty($article['journal_id']) ? \App\Models\Journal::find($article['journal_id']) : null;

    $journalName = $journalModel ? $journalModel->name : $article['journal'] ?? 'Jurnal Musytari';
    $journalUrl = $journalModel && $journalModel->link ? $journalModel->link : $article['journal_url'] ?? 'https://journal.cib.institute/index.php/musytari/article/view/2661';

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

    $ieeeAuthors = is_array($article['authors'])
        ? implode(
            ', ',
            array_map(function ($a) {
                $parts = explode(' ', trim($a));
                $lastName = array_pop($parts);
                $firstInit = count($parts) > 0 ? mb_substr($parts[0], 0, 1) . '. ' : '';
                return $firstInit . $lastName;
            }, $article['authors']),
        )
        : $article['authors'];

    // Split multiline string from database into array of reference lines
    $referencesList = is_array($article['references'] ?? null)
        ? $article['references']
        : array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($article['references'] ?? '')))));

    // Split keywords string into array of individual keywords
    $keywordsList = is_array($article['keywords'] ?? null) ? $article['keywords'] : array_values(array_filter(array_map('trim', preg_split('/[;,]/', (string) ($article['keywords'] ?? '')))));

    $apaCitation = $citationAuthors . " (" . $article['year'] . "). " . $article['title'] . ". " . $journalName . ", " . $article['volume'] . "(" . $article['issue'] . "). " . $article['doi_url'];
    $ieeeCitation = $ieeeAuthors . ", \"" . $article['title'] . ",\" " . $journalName . ", vol. " . $article['volume'] . ", no. " . $article['issue'] . ", " . $article['year'] . ", doi: " . ($article['doi'] ?? '') . ".";
    $harvardCitation = $citationAuthors . ", " . $article['year'] . ". " . $article['title'] . ". " . $journalName . ", " . $article['volume'] . "(" . $article['issue'] . "). Available at: <" . $article['doi_url'] . ">.";

    $bibtexCitation =
        "@article{oktavia" . $article['year'] . "pengaruh,\n" .
        "  title={{ " . $article['title'] . " }},\n" .
        "  author={" . implode(' and ', $article['authors']) . "},\n" .
        "  journal={{ " . $journalName . " }},\n" .
        "  volume={{ " . $article['volume'] . " }},\n" .
        "  number={{ " . $article['issue'] . " }},\n" .
        "  year={{ " . $article['year'] . " }},\n" .
        "  publisher={{ " . ($article['publisher'] ?? '') . " }},\n" .
        "  doi={{ " . ($article['doi'] ?? '') . " }}\n" .
        "}";

    $risCitation =
        "TY  - JOUR\n" .
        "TI  - " . $article['title'] . "\n" .
        implode("\n", array_map(fn($a) => "AU  - " . $a, $article['authors'])) . "\n" .
        "JO  - " . $journalName . "\n" .
        "VL  - " . $article['volume'] . "\n" .
        "IS  - " . $article['issue'] . "\n" .
        "PY  - " . $article['year'] . "\n" .
        "PB  - " . ($article['publisher'] ?? '') . "\n" .
        "DO  - " . ($article['doi'] ?? '') . "\n" .
        "ER  -";

@endphp

<x-app-layout>
    <x-slot name="title">{{ $article['title'] }} - Cahaya Ilmu Bangsa</x-slot>

    <x-slot name="meta">
        <!-- Google Scholar / Highwire Scholarly Meta Tags -->
        <meta name="citation_title" content="{{ $article['title'] }}">
        @foreach ((array) $article['authors'] as $index => $author)
            <meta name="citation_author" content="{{ $author }}">
            @if (!empty($article['author_institutions'][$author]))
                <meta name="citation_author_institution" content="{{ $article['author_institutions'][$author] }}">
            @elseif (!empty($article['author_institutions'][$index]))
                <meta name="citation_author_institution" content="{{ $article['author_institutions'][$index] }}">
            @elseif (!empty($article['author_institution']))
                <meta name="citation_author_institution" content="{{ $article['author_institution'] }}">
            @endif
        @endforeach
        <meta name="citation_publication_date" content="{{ $article['date'] }}">
        <meta name="citation_journal_title" content="{{ $journalName }}">
        <meta name="citation_publisher" content="{{ $article['publisher'] }}">
        <meta name="citation_volume" content="{{ $article['volume'] }}">
        <meta name="citation_issue" content="{{ $article['issue'] }}">
        <meta name="citation_doi" content="{{ $article['doi'] }}">
        <meta name="citation_pdf_url" content="{{ $article['pdf_url'] }}">
        <meta name="citation_abstract_html_url" content="{{ request()->url() }}">
        <meta name="citation_fulltext_html_url" content="{{ request()->url() }}">
        <meta name="citation_language" content="{{ $article['language'] }}">
        @if (!empty($keywordsList))
            @foreach ($keywordsList as $keyword)
                <meta name="citation_keywords" content="{{ $keyword }}">
            @endforeach
        @endif

        <!-- Google Scholar Citation References Indexing Metadata -->
        @if (!empty($referencesList))
            @foreach ($referencesList as $reference)
                <meta name="citation_reference" content="{{ $reference }}">
            @endforeach
        @endif

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

            <!-- Left Main Content Column (Abstract + PDF Preview + References) -->
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
                    <p class="text-justify text-sm font-normal leading-relaxed text-slate-700 sm:text-base">
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

                <!-- References Section (Daftar Pustaka / Scholar References) -->
                @if (!empty($referencesList))
                    <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm sm:p-8">
                        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 pb-4">
                            <h2 class="font-heading flex items-center gap-2 text-xl font-bold text-slate-900 sm:text-2xl">
                                <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <span>Daftar Pustaka / References</span>
                            </h2>
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">
                                <svg class="h-3.5 w-3.5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 24C5.373 24 0 18.627 0 12S5.373 0 12 0s12 5.373 12 12-5.373 12-12 12zm-3.6-13.8v7.2l6.6-3.6-6.6-3.6z" />
                                </svg>
                                Google Scholar Indexing Metadata
                            </span>
                        </div>
                        <ol class="list-decimal space-y-3.5 pl-5 text-sm leading-relaxed text-slate-700">
                            @foreach ($referencesList as $ref)
                                <li class="pl-1 transition-colors hover:text-slate-900">{{ $ref }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endif


            </div>

            <!-- Right Side Section (Sidebar Column) -->
            <aside class="space-y-6 lg:col-span-4">

                <!-- Quick Download & Action Card -->
                <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
                    <h3 class="font-heading flex items-center gap-2 border-b border-slate-100 pb-3 text-lg font-bold text-slate-900">
                        <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 01-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
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

                        <a href="{{ $journalUrl }}" target="_blank" rel="noopener noreferrer"
                            class="flex w-full items-center justify-between rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-semibold text-slate-800 transition-all hover:bg-slate-100">
                            <span>{{ $journalName }} (CIB)</span>
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
                            <span class="mb-0.5 block text-slate-500">Penulis & Afiliasi:</span>
                            <span class="font-bold text-slate-900">{{ $authorsString }}</span>
                            @if (!empty($article['author_institution']))
                                <span class="mt-0.5 block text-xs font-semibold text-slate-600">{{ $article['author_institution'] }}</span>
                            @endif
                        </div>
                        <div class="pt-2">
                            <span class="mb-0.5 block text-slate-500">Jurnal / Penerbit:</span>
                            <span class="font-semibold text-slate-800">{{ $journalName }} &bull; {{ $article['publisher'] }}</span>
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

                <!-- Multi-Format Citation & Scholar Metadata Export Card -->
                <div class="space-y-4 rounded-2xl border border-slate-200/80 bg-white p-6 text-sm shadow-sm" x-data="{ activeTab: 'apa' }">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h3 class="font-heading flex items-center gap-2 text-lg font-bold text-slate-900">
                            <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                            </svg>
                            <span>Sitasi & Metadata</span>
                        </h3>
                    </div>

                    <!-- Citation Format Switcher Pill Buttons -->
                    <div class="flex flex-wrap items-center gap-1.5 rounded-full border border-slate-200/80 bg-slate-100/80 p-1 text-xs font-semibold">
                        <button type="button" @click="activeTab = 'apa'"
                            :class="activeTab === 'apa' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60'"
                            class="cursor-pointer rounded-full px-3.5 py-1.5 transition-all">APA 7th</button>
                        <button type="button" @click="activeTab = 'ieee'"
                            :class="activeTab === 'ieee' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60'"
                            class="cursor-pointer rounded-full px-3.5 py-1.5 transition-all">IEEE</button>
                        <button type="button" @click="activeTab = 'harvard'"
                            :class="activeTab === 'harvard' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60'"
                            class="cursor-pointer rounded-full px-3.5 py-1.5 transition-all">Harvard</button>
                        <button type="button" @click="activeTab = 'bibtex'"
                            :class="activeTab === 'bibtex' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60'"
                            class="cursor-pointer rounded-full px-3.5 py-1.5 transition-all">BibTeX</button>
                        <button type="button" @click="activeTab = 'ris'"
                            :class="activeTab === 'ris' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-200/60'"
                            class="cursor-pointer rounded-full px-3.5 py-1.5 transition-all">RIS</button>
                    </div>

                    <!-- APA Content -->
                    <div x-show="activeTab === 'apa'" class="space-y-2">
                        <div class="select-all rounded-xl border border-slate-200 bg-slate-50 p-3.5 font-mono text-xs leading-relaxed text-slate-700">
                            {{ $apaCitation }}
                        </div>
                        <button onclick="navigator.clipboard.writeText(`{{ addslashes($apaCitation) }}`); alert('Sitasi APA berhasil disalin!');"
                            class="flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-slate-100 py-1.5 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-200">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Salin Sitasi APA</span>
                        </button>
                    </div>

                    <!-- IEEE Content -->
                    <div x-show="activeTab === 'ieee'" class="space-y-2" x-cloak>
                        <div class="select-all rounded-xl border border-slate-200 bg-slate-50 p-3.5 font-mono text-xs leading-relaxed text-slate-700">
                            {{ $ieeeCitation }}
                        </div>
                        <button onclick="navigator.clipboard.writeText(`{{ addslashes($ieeeCitation) }}`); alert('Sitasi IEEE berhasil disalin!');"
                            class="flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-slate-100 py-1.5 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-200">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Salin Sitasi IEEE</span>
                        </button>
                    </div>

                    <!-- Harvard Content -->
                    <div x-show="activeTab === 'harvard'" class="space-y-2" x-cloak>
                        <div class="select-all rounded-xl border border-slate-200 bg-slate-50 p-3.5 font-mono text-xs leading-relaxed text-slate-700">
                            {{ $harvardCitation }}
                        </div>
                        <button onclick="navigator.clipboard.writeText(`{{ addslashes($harvardCitation) }}`); alert('Sitasi Harvard berhasil disalin!');"
                            class="flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-slate-100 py-1.5 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-200">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Salin Sitasi Harvard</span>
                        </button>
                    </div>

                    <!-- BibTeX Content -->
                    <div x-show="activeTab === 'bibtex'" class="space-y-2" x-cloak>
                        <pre class="select-all whitespace-pre-wrap rounded-xl border border-slate-200 bg-slate-50 p-3.5 font-mono text-[11px] leading-relaxed text-slate-700">{{ $bibtexCitation }}</pre>
                        <button onclick="navigator.clipboard.writeText(`{{ addslashes($bibtexCitation) }}`); alert('Metadata BibTeX berhasil disalin!');"
                            class="flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-slate-100 py-1.5 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-200">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Salin BibTeX</span>
                        </button>
                    </div>

                    <!-- RIS Content -->
                    <div x-show="activeTab === 'ris'" class="space-y-2" x-cloak>
                        <pre class="select-all whitespace-pre-wrap rounded-xl border border-slate-200 bg-slate-50 p-3.5 font-mono text-[11px] leading-relaxed text-slate-700">{{ $risCitation }}</pre>
                        <button onclick="navigator.clipboard.writeText(`{{ addslashes($risCitation) }}`); alert('Metadata RIS (EndNote/RefMan) berhasil disalin!');"
                            class="flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-slate-100 py-1.5 text-xs font-semibold text-slate-700 transition-colors hover:bg-slate-200">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span>Salin Format RIS</span>
                        </button>
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
