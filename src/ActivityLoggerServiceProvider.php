<?php

namespace Minhajul\ActivityLogger;

use Illuminate\Support\ServiceProvider;
use Minhajul\ActivityLogger\Commands\DeleteOlderActivity;

class ActivityLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/activity-log.php' => config_path('activity-log.php')
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        if ($this->app->runningInConsole()){
            $this->commands([
                DeleteOlderActivity::class
            ]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
