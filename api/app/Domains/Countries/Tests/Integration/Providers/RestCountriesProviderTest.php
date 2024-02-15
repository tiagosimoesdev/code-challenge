<?php

namespace App\Domains\Countries\Tests\Integration\Providers;

use App\Domains\Countries\Exceptions\CountryProviderException;
use App\Domains\Countries\Interfaces\CountryProviderInterface;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\IntegrationTestCase;

class RestCountriesProviderTest extends IntegrationTestCase
{
    /**
     * @test
     */
    public function it_gets_all_countries(): void
    {

        Http::fake([
            config('countries.external-apis.rest-countries.url') => Http::response($this->getSampleApiResponse()),
        ]);

        $countryProvider = app(CountryProviderInterface::class);

        $result = $countryProvider->getAll();


        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals('Country1', $result->first()->name);
        $this->assertEquals('flag1.svg', $result->first()->flag);
        $this->assertEquals('Country2', $result->last()->name);
        $this->assertEquals('flag2.svg', $result->last()->flag);

    }

    private function getSampleApiResponse(): array
    {
        return [
            ['name' => ['common' => 'Country1'], 'flags' => ['svg' => 'flag1.svg']],
            ['name' => ['common' => 'Country2'], 'flags' => ['svg' => 'flag2.svg']],
        ];
    }

    /**
     * @test
     */
    public function it_should_cache_all_countries(): void
    {

        Http::fake([
            config('countries.external-apis.rest-countries.url') => Http::response($this->getSampleApiResponse()),
        ]);


        Cache::shouldReceive('remember')
            ->once()
            ->with('countries.external-apis.providers.rest-countries.cache', 60 * 60 * 24, Closure::class)
            ->andReturn($this->getSampleApiResponse());

        $countryProvider = app(CountryProviderInterface::class);

        $result = $countryProvider->getAll();


        $this->assertInstanceOf(Collection::class, $result);

        $this->assertEquals('Country1', $result->first()->name);
        $this->assertEquals('flag1.svg', $result->first()->flag);
        $this->assertEquals('Country2', $result->last()->name);
        $this->assertEquals('flag2.svg', $result->last()->flag);

    }

    /**
     * @test
     */
    public function it_throws_exception_when_api_fails(): void
    {

        Http::fake([
            config('countries.external-apis.rest-countries.url') => Http::response([], 500),
        ]);

        $countryProvider = app(CountryProviderInterface::class);

        $this->expectException(CountryProviderException::class);
        $this->expectExceptionMessage('Failed to fetch countries');

        $countryProvider->getAll();


    }

}
