<?php namespace Odesk;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Odesk\Phystrix\ApcStateStorage;
use Odesk\Phystrix\CommandFactory;
use Odesk\Phystrix\StateStorageInterface;

class ServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->app->when(CommandFactory::class)
                  ->needs('$config')
                  ->give(function () {
                      return config('phystrix');
                  });

        $this->app->bind(StateStorageInterface::class, ApcStateStorage::class);
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
