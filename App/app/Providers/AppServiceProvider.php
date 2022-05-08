<?php

namespace App\Providers;

use App\Services\ActiveCollab\ActiveCollabHttpService;
use App\Services\Clockify\ClockifyHttpService;
use App\Services\Guzzle\GuzzleHttpService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GuzzleHttpService::class);
        $this->app->singleton(ClockifyHttpService::class);
        $this->app->singleton(ActiveCollabHttpService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
