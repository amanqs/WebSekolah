<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        if (request()->header('x-forwarded-proto') === 'https' || str_contains(request()->header('host', ''), 'ngrok')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share $settings globally with ALL views (layouts, pages, partials, components)
        View::composer('*', function ($view) {
            try {
                $settings = app(GeneralSettings::class);
                $view->with('settings', $settings);
            } catch (\Throwable $e) {
                // Failsafe during fresh migrations
            }
        });
    }
}
