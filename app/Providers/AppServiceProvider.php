<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Blade::directive('allChildGroup', function ($expression) {
        return "<?php echo allChildGroup($expression); ?>";

    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
