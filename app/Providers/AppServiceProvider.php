<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $components = [
            'User'
        ];

        foreach ($components as $component) {
            $this->app->bind("App\\Interfaces\\{$component}Interface", "App\\Repositories\\{$component}Repository");
        }
    }
}
