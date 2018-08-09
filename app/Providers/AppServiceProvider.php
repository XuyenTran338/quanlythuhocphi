<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
/*use Illuminate\Support\Facades\Validator;*/

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);

        /*Validator::extend('date_after', function($attribute, $value, $parameters) {
            return strtotime( $value ) > strtotime( $this->$attribute[ $parameters[0] ] );
        });

        Validator::extend('date_equal', function($attribute, $value, $parameters) {
            return strtotime( $value ) == strtotime( $this->$attribute[ $parameters[0] ] );
        });*/
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
