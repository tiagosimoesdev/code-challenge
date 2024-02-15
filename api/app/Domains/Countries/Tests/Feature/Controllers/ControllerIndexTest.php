<?php

namespace App\Domains\Countries\Tests\Feature\Controllers;

use App\Domains\Countries\Enums\CountryProviderEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\FeatureTestCase;

class ControllerIndexTest extends FeatureTestCase
{

    private string $endpoint = 'api/v1/countries';

    public function setUp(): void
    {
        parent::setUp();

        Config::set('provider', CountryProviderEnum::REST_COUNTRIES->value);

        $this->authenticate();

    }


    /** @test */
    public function it_restricts_access_to_unauthenticated_users(): void
    {
        Auth::logout();

        $this->getJson($this->endpoint)
            ->assertUnauthorized();

    }

    /**
     * @test
     */
    public function it_gets_all_countries(): void
    {

        Http::fake([
            config('countries.external-apis.rest-countries.url') => Http::response($this->getSampleApiResponse()),
        ]);

        $this->getJson($this->endpoint)
            ->assertOk()
            ->assertJson([
                'data' => [
                    ['name' => 'Country1', 'flag' => 'flag1.svg'],
                    ['name' => 'Country2', 'flag' => 'flag2.svg'],
                ]
            ]);
    }


    private function getSampleApiResponse(): array
    {
        return [
            ['name' => ['common' => 'Country1'], 'flags' => ['svg' => 'flag1.svg']],
            ['name' => ['common' => 'Country2'], 'flags' => ['svg' => 'flag2.svg']],
        ];
    }

}
