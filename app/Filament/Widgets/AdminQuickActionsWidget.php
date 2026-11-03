<?php

namespace App\Filament\Widgets;

use App\Models\BukuNonTeks;
use App\Models\Lpj;
use App\Models\Post;
use App\Models\PpdbRegistration;
use App\Models\Teacher;
use Filament\Widgets\Widget;

class AdminQuickActionsWidget extends Widget
{
    protected static string $view = 'filament.widgets.admin-quick-actions-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    public function getViewData(): array
    {
        return [
            'pending_ppdb_count' => PpdbRegistration::where('status', 'pending')->count(),
            'total_posts' => Post::count(),
            'total_teachers' => Teacher::count(),
            'total_lpj' => Lpj::count(),
            'total_buku' => BukuNonTeks::count(),
        ];
    }
}

