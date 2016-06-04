<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use App\Supports\Auth\CustomProfileProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        
        //自定义验证
        Auth::provider('custom', function($app, $config) {
            return new CustomProfileProvider($app['hash'], $config['model']);
        });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
