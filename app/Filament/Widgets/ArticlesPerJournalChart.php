<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Journal;
use Filament\Widgets\ChartWidget;

class ArticlesPerJournalChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Artikel per Jurnal';

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $journals = Journal::all();
        $labels = [];
        $data = [];

        foreach ($journals as $journal) {
            $count = Article::where('journal_id', $journal->id)->count();
            if ($count > 0) {
                $labels[] = $journal->name;
                $data[] = $count;
            }
        }

        if (empty($data)) {
            $labels = ['Belum Ada Data'];
            $data = [0];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Artikel',
                    'data' => $data,
                    'backgroundColor' => [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
