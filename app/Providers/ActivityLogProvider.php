<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ActivityLogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/Activity_Log.php');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
