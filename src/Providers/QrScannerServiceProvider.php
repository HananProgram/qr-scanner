<?php
namespace Services\QrScanner\Providers;

use Illuminate\Support\ServiceProvider;
use Services\QrScanner\Services\QrScanner;

class QrScannerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/qr.php', 'qr');
        $this->app->singleton(QrScanner::class, fn() => new QrScanner());
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/qr.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->publishes([__DIR__.'/../../config/qr.php' => config_path('qr.php')], 'qr-config');
    }
}
