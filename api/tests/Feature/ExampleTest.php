<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Repositories\UserRepository;
use Auth0\Laravel\Contract\Auth\Guard;
use Auth0\SDK\Auth0;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function web_test(): void
    {
        $user = UserFactory::new()->create();


        $this->actingAs($user);

        $response = $this->get('/private')
            ->dump()
            ->assertOk();

    }

    /**
     * @test
     */
    public function api_test(): void
    {

/*        $user = UserFactory::new()->create();
        $response = $this->actingAs($user,'auth0')->json('GET', '/api/private', ['title' => 'Welcome to Mars']);
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'created' => true,
            ]);

        $user = UserFactory::new()->create();


       Auth::setUser($user);*/
     $accessToken = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IndtY3dQUUQtaUx2Yi1lNU1TZ3VLQiJ9.eyJpc3MiOiJodHRwczovL2Rldi0wZmZiZTg2Y2xxenN2cmdzLnVzLmF1dGgwLmNvbS8iLCJzdWIiOiJMMTh1WVFNZjVqU0ZkcHRwZWNEZ1pCNmVDSlFITnpvREBjbGllbnRzIiwiYXVkIjoiYXBpZG9pcyIsImlhdCI6MTcwNzc2OTkzMywiZXhwIjoxNzA3ODU2MzMzLCJhenAiOiJMMTh1WVFNZjVqU0ZkcHRwZWNEZ1pCNmVDSlFITnpvRCIsImd0eSI6ImNsaWVudC1jcmVkZW50aWFscyJ9.RaIxl0neYkJJI8Y-qj27u5zBGinhsKaGwRtW6Yu03gbnjJJ6QId0Q0qNQeW5ak80HxrDVAlF1JBE2X2EWFkewbMZZb84OQGUnM2SH5RWOjMRW3D-8J7TnPrPMev3AWSQR0NIQpa8aPlbgjUKMrhJl93g9_2NvEid4C6_FGpYJpjYcPLzPEKGgpmHDA4wu47XWtpF_2jxFOWGUbsY9JV1PbonzwVGeNCkXL6lCdbvK5basRfy3U_o7PVff0yM3evnyfVzTFhs29p_XDHBY8yL9u-He8p4iqDD4b_SwL4MuD-jjQy-RriB5DPgbFpAv42xWBLGCBfhgz9uYqFzfWpMEQ';


        $this->withToken('Bearer ' . $accessToken)->getJson('/api/', )
            ->dump()
            ->assertOk();

    }
}
