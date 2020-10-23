<?php

namespace App\Providers;

use App\Libraries\RewardConverter;
use App\Libraries\RewardRandomator;
use Illuminate\Support\Facades\App;
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
        App::bind('reward_randomator',function() {
            return new RewardRandomator;
        });

        App::bind('reward_converter',function() {
            return new RewardConverter;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
