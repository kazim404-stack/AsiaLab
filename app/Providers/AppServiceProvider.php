<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $realPublicPath = base_path('../public_html/asialab/public');

        if (is_dir($realPublicPath)) {
            App::bind('path.public', function () use ($realPublicPath) {
                return $realPublicPath;
            });
        }
    }
}
