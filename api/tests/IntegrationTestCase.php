<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class IntegrationTestCase extends UnitTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }
}
