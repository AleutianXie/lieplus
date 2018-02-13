<?php

namespace Cici\Lieplus;

use Illuminate\Support\ServiceProvider;
use Cici\Lieplus\Contracts\Resume as ResumeContract;

class LieplusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // load views template
        $this->loadViewsFrom(__DIR__ . '/views', 'Lieplus');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/cici/lieplus'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResumeContract::class);
        //$this->app->bind(RoleContract::class, $config['role']);
    }
}
