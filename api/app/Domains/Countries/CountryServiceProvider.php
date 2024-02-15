<?php

namespace App\Domains\Countries;

use App\Domains\Countries\Enums\CountryProviderEnum;
use App\Domains\Countries\Interfaces\CountryProviderInterface;
use App\Domains\Countries\Providers\RestCountriesProvider;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CountryServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        $this->mergeConfigFrom(
            __DIR__ . '/Config/external-apis.php',
            'countries.external-apis'
        );

        $this->registerTransformers();
        $this->registerRoutes();
    }

    private function registerTransformers(): void
    {
        // $this->app->bind('GearAutomationConfigTransformer', GearAutomationConfigTransformer::class);
    }

    private function registerRoutes(): void
    {
        Route::prefix('api/v1/countries')
            ->middleware(['auth', 'api'])
            ->as('v1.countries')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . DIRECTORY_SEPARATOR . 'CountryRouter.php');
            });
    }

    public function register(): void
    {
        $this->app->bind(CountryProviderInterface::class, function ($app) {
            return match (config('countries.external-apis.provider')) {
                CountryProviderEnum::REST_COUNTRIES => new RestCountriesProvider(),
                default => new RestCountriesProvider(),
            };
        });
    }


}
