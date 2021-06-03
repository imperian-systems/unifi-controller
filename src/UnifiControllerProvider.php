<?php

namespace ImperianSystems\UnifiController;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class UnifiControllerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'unifi-controller');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(!$this->app->routesAreCached())
        {
            require __DIR__.'/Routes.php';
        }

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('unifi-controller.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/Seeders/UnifiSiteSeeder.php' => database_path('seeders/UnifiSiteSeeder.php'),
        ], 'seeders');
    }
}
