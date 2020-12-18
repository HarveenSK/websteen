<?php

namespace App\Providers;

use App\Http\Client\ChiptuningClient;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ChiptuningClient::class, function ()
        {
            return new ChiptuningClient(
                config('chiptuning.api.url'),
                config('chiptuning.api.key')
            );
        });

    }
}
