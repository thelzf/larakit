<?php

namespace Larakit;

use Illuminate\Support\ServiceProvider;

class LarakitServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Os helpers já são carregados via composer.json (autoload files)
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Você pode publicar configurações se quiser
        // $this->publishes([
        //     __DIR__.'/../config/larakit.php' => config_path('larakit.php'),
        // ], 'larakit-config');
    }
}