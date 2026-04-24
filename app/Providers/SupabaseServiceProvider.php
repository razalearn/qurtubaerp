<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Supabase\LaravelPhp\Facades\Supabase;

class SupabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge the config file
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/supabase.php',
            'supabase'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish config
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/supabase.php' => config_path('supabase.php'),
            ], 'supabase-config');
        }
    }
}
