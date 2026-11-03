<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class DeveloperSystemWidget extends Widget
{
    protected static string $view = 'filament.widgets.developer-system-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 0;

    public static function canView(): bool
    {
        return auth()->user()?->hasRole('Super Admin') ?? false;
    }

    public function getData(): array
    {
        return [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'environment' => app()->environment(),
            'storage_linked' => file_exists(public_path('storage')),
            'server_os' => PHP_OS_FAMILY,
            'db_name' => config('database.connections.' . config('database.default') . '.database'),
        ];
    }
}

