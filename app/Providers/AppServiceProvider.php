<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer', 'JWT')
            );
        });

        //todo write it cleaner
        Blueprint::macro('audits', function () {
            $this->foreignId('created_by')->nullable()->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $this->foreignId('updated_by')->nullable()->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
}
