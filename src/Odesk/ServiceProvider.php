<?php namespace Odesk;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Odesk\Phystrix\CommandFactory;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->when(CommandFactory::class)
                  ->needs('$config')
                  ->give(config('phystrix'));
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/phystrix.php' => config_path('phystrix.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/phystrix.php',
            'phystrix'
        );
    }
}
