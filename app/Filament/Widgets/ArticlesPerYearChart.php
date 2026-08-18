<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class ArticlesPerYearChart extends ChartWidget
{
    protected ?string $heading = 'Statistik Publikasi per Tahun';

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $stats = Article::select(DB::raw('YEAR(published_date) as year, count(*) as count'))
            ->whereNotNull('published_date')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $labels = [];
        $data = [];

        foreach ($stats as $stat) {
            $labels[] = $stat->year;
            $data[] = $stat->count;
        }

        if (empty($data)) {
            $labels = [date('Y')];
            $data = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Artikel Diterbitkan',
                    'data' => $data,
                    'borderColor' => '#f97316',
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
