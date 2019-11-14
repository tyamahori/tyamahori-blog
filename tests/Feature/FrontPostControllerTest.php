<?php

namespace Tests\Feature;

use Tests\TestCase;
use Config;
use Artisan;

class FrontPostControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        $this->seed('DatabaseSeeder');
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }

    /**
     * @test
     */
    public function isTopPageDisplayed(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function IsProfilePageDisplayed(): void
    {
        $response = $this->get('/profile');
        $response->assertStatus(200);
    }
}
