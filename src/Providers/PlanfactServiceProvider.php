<?php

namespace JSPHPCoder\LaravelPlanfact\Providers;

use Illuminate\Support\ServiceProvider;

class PlanfactServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/planfact.php', 'planfact'
        );
    }

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'planfact');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/planfact.php' => config_path('planfact.php'),
                __DIR__ . '/../../lang' => $this->app->langPath('vendor/planfact'),
            ]);
        }
    }
}
