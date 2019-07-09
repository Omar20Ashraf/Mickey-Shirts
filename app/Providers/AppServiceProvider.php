<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(150);

        // $this->publishes([
        //     __DIR__.'/vendor/bitfumes/laravel-multiauth/src/Http/Controllers' => base_path('app/Http/Controllers/Admin/vendor/Controllers'),
        // ]);
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
