<?php

namespace App\Providers;

use App\University;
use Illuminate\Support\ServiceProvider;

class UniversityProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('student', function($view){
            $view->with('items', University::all());
        });

        view()->composer('organization', function($view) {
            $view->with('items', University::all());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
