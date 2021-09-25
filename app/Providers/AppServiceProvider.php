<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;

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
        //create_controllers();

        update_user();

        create_langues();

        Schema::defaultStringLength(191);

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

        
    }
}
