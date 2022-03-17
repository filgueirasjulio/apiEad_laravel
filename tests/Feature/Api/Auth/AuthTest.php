<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use App\Models\User;
use Tests\Traits\UtilsTrait;

class AuthTest extends TestCase
{
    use UtilsTrait;
    
    public $user;
    public $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->token =  $this->generateToken();
    }

    public function test_fail_auth()
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function test__auth()
    {
        $response = $this->postJson('/auth', []);

        $response = $this->postJson('/auth', [
            'email' => $this->user->email,
            'password' => 'password',
            'device_name' => 'test'
        ]);

        $response->assertStatus(200);
    }

    public function test_error_logout()
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $response = $this->postJson('/logout', [], [
            'Authorization' => "Bearer {$this->token}",
        ]);

        $response->assertStatus(200);
    }

    public function test_error_get_me()
    {
        $response = $this->getJson('/me');

        $response->assertStatus(401);
    }

    public function test_get_me()
    {
        $response = $this->getJson('/me', [
            'Authorization' => "Bearer {$this->token}",
        ]);

        $response->assertStatus(200);
    }
}
