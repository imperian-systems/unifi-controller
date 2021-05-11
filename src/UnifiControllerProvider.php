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
    }
}
