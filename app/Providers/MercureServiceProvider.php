<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mercure\Hub;
use Symfony\Component\Mercure\Jwt\StaticTokenProvider;

class MercureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(Hub::class, function () {
            return new Hub(config('mercure.url'), new StaticTokenProvider(config('mercure.jwt.value')));
        });
    }
}
