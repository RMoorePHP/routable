<?php

namespace RMoore\Filterable;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/filterable.php',
            'filterable'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/filterable.php' => config_path('filterable.php'),
        ], 'config');
    }
}
