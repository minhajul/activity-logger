<?php

namespace Minhajul\ActivityLog;

use Illuminate\Support\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider
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
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->singleton(ActivityLog::class, function (){
//            return new ActivityLog();
//        });
//
//        $this->app->alias(ActivityLog::class, 'Activity');
    }
}
