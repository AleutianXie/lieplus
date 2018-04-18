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
        // load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // load views template
        $this->loadViewsFrom(__DIR__ . '/views', 'Lieplus');
        // load routes
        $this->loadRoutesFrom(__DIR__. '/routes/web.php');

        $this->publishes([
            __DIR__.'/config/lieplus.php' => config_path('lieplus.php'),
        ]);

        $this->publishes([
            __DIR__.'/../database/data/' => database_path('data/vendor/cici/lieplus'),
        ]);
        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds'),
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
