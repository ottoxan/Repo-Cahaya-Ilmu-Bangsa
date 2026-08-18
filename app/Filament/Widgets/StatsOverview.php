<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\DownloadLog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Artikel', Article::where('status', 'published')->count())
                ->description('Artikel yang terpublikasi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            Stat::make('Total Kunjungan (Views)', ArticleView::count())
                ->description('Total kunjungan halaman artikel')
                ->descriptionIcon('heroicon-m-eye')
                ->color('info'),
            Stat::make('Total Unduhan PDF', DownloadLog::count())
                ->description('Total unduhan naskah PDF')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('warning'),
            Stat::make('Total DOI Terdaftar', Article::whereNotNull('doi')->where('doi', '!=', '')->count())
                ->description('Artikel dengan identifikasi DOI')
                ->descriptionIcon('heroicon-m-link')
                ->color('danger'),
        ];
    }
}
