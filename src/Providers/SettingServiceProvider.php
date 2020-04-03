<?php

namespace JanisKelemen\Setting\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
        ], 'setting');

        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../../config/setting.php' => config_path('setting.php'),
        ], 'setting');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/setting.php',
        'setting'
        );
        $settingModel = config('laravel-setting.model', \JanisKelemen\Setting\EloquentStorage::class);
        // Register the service the package provides.
        $this->app->bind('Setting', \JanisKelemen\Setting\Setting::class);
        $this->app->bind(\JanisKelemen\Setting\Contracts\SettingStorageContract::class, $settingModel);
    }
}
