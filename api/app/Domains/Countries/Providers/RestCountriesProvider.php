<?php

namespace App\Domains\Countries\Providers;

use App\Domains\Countries\DataTransferObjects\CountryDto;
use App\Domains\Countries\Exceptions\CountryProviderException;
use App\Domains\Countries\Interfaces\CountryProviderInterface;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class RestCountriesProvider implements CountryProviderInterface
{

    private const CONFIG_KEY = 'countries.external-apis.providers.rest-countries';
    private const CACHE_KEY = 'countries.external-apis.providers.rest-countries.cache';
    private const CACHE_TTL = 60 * 60 * 24;

    public function __construct()
    {
    }

    /**
     * @return Collection<CountryDto>
     * @throws CountryProviderException
     */
    public function getAll(): Collection
    {
        try {
            $config = config(self::CONFIG_KEY);
            $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, static function () use ($config) {
                $response = Http::get($config['url']);
                if (!$response->successful()) {
                    throw CountryProviderException::failedToFetchCountries();
                }
                return $response->json();
            });

            return collect($data)
                ->map(function ($country) {
                    return new CountryDto(
                        flag: $country['flags']['svg'],
                        name: $country['name']['common'],

                    );
                });
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            throw CountryProviderException::failedToFetchCountries();

        }
    }

}
