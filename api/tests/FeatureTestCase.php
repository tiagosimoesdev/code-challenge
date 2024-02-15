<?php

namespace Tests;

use Database\Factories\UserFactory;

abstract class FeatureTestCase extends IntegrationTestCase
{

    public function setUp(): void
    {
        parent::setUp();

    }

    protected function authenticate(): void
    {
        $this->actingAs(UserFactory::new()->create(), 'auth0-api');
    }


}
