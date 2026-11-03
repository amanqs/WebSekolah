<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class PostsCategoryChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Berita per Kategori';

    protected static ?int $sort = 4;

    protected static ?string $maxHeight = '260px';

    protected function getData(): array
    {
        $categories = Category::withCount('posts')->get();

        $labels = [];
        $data = [];

        foreach ($categories as $cat) {
            $labels[] = $cat->name;
            $data[] = $cat->posts_count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Berita',
                    'data' => $data,
                    'backgroundColor' => '#1E3A8A',
                    'borderRadius' => 8,
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

