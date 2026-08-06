@props([
    'title' => 'PENGARUH KUALITAS LAYANAN, PROMOSI DAN LOKASI TERHADAP KEPUTUSAN ORANG TUA MEMILIH BIMBA AIUEO RAWALUMBU BEKASI',
    'abstract' => 'The background of this study stems from the increasingly competitive landscape among early childhood education institutions. This situation pushes each institution to better understand what factors parents actually consider when choosing a place for their children to learn.',
    'category' => 'Manajemen Pendidikan & Bisnis',
    'date' => '5 Ags 2026',
    'authors' => ['Syerliananda Oktavia', 'Indra Muis'],
    'slug' => 'sample-article'
])

@php
    if (is_iterable($authors) && !is_string($authors)) {
        $authorList = collect($authors)
            ->map(fn($item) => is_object($item) ? ($item->name ?? (string) $item) : (string) $item)
            ->filter()
            ->values();
    } elseif (is_string($authors) && str_contains($authors, ';')) {
        $authorList = collect(explode(';', $authors))
            ->map(fn($item) => trim($item))
            ->filter()
            ->values();
    } elseif (is_string($authors)) {
        $authorList = collect([trim($authors)])->filter()->values();
    } else {
        $authorList = collect([(string) $authors])->filter()->values();
    }
@endphp

<article class="group glass-card hover:bg-white/95 border border-white/80 hover:border-orange-300/80 rounded-2xl p-6 sm:p-7 shadow-sm hover:shadow-xl hover:shadow-orange-500/5 transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
    
    <!-- Left Main Content -->
    <div class="flex-grow space-y-2.5 max-w-4xl">
        
        <!-- Category & Metadata Header -->
        <div class="flex flex-wrap items-center gap-3 text-xs">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-orange-500/10 text-orange-700 border border-orange-200">
                {{ $category }}
            </span>
            <span class="text-slate-400">&bull;</span>
            <span class="text-slate-500 font-medium">{{ $date }}</span>
        </div>

        <!-- Title -->
        <h3 class="text-lg sm:text-xl font-bold font-heading text-slate-900 group-hover:text-orange-600 transition-colors leading-snug">
            <a href="{{ route('article.show', ['slug' => $slug]) }}" class="hover:underline decoration-orange-500/30">
                {{ $title }}
            </a>
        </h3>
        <!-- Author Tag -->
        <div class="flex items-center gap-2 pt-1 text-xs text-slate-500">
            <span class="font-semibold text-slate-700">{{ $authorList->join('; ') }}</span>
        </div>

        <!-- Abstract -->
        <p class="text-xs sm:text-sm text-slate-600 line-clamp-1 leading-relaxed font-normal">
            {{ $abstract }}
        </p>


    </div>

    <!-- Right Action Button -->
    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-3 shrink-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-slate-100">
        <a href="{{ route('article.show', ['slug' => $slug]) }}" 
           class="px-5 py-2.5 rounded-full bg-slate-950 hover:bg-orange-600 text-white font-bold text-xs shadow-md transition-all transform group-hover:scale-105 flex items-center gap-1.5 whitespace-nowrap">
            <span>Baca Artikel</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

</article>
