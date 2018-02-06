<?php

namespace App\Providers;

use DB;
use Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (env('SQL_LOG')) {
            DB::listen(function ($query) {
                Log::info(sprintf(
                    "\nsql: %s\nbinds: %s\ntime: %s",
                    $query->sql,
                    var_export($query->bindings, true),
                    $query->time
                ));
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
