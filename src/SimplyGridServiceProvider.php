<?php

namespace spimpolari\LaravelSimplyGrid;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class SimplyGridServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'SimplyGrid');
        $this->publishes([__DIR__ . '/Views' => resource_path('views/vendor/LaravelSimplyGrid')]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('simplygrid', function() {
            return new \spimpolari\LaravelSimplyGrid\Support\DataTable;
        });
    }



}