<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAuthenticateTest extends TestCase
{
    /**
     * A basic feature of the application.
     */
    public function test_successful_authentication(): void
    {
        $this->assertDatabaseHas('users', [
            'email' => 'root@gmail.com'
        ]);

        $response = $this->postJson('/api/sign-in', [
            'email' => 'root@gmail.com',
            'password' => 'root'
        ]);

        $response->assertStatus(201);
    }
}






