<?php

namespace Tests\Feature;

use Domains\User\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function canUserLogin()
    {
        $payload = [
            'email' => $this->user->email,
            'password' => 'password',
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function withoutEmail()
    {
        $payload = [
            'email' => 'qualquer.um@mail.com',
            'password' => 'password',
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function cantNotWithoutLogin()
    {
        $payload = [
            'email' => $this->user->email,
            'password' => 'passwordSD',
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function aAuthRequireEmail()
    {
        $payload = [
            'email' => '',
            'password' => 'passwordSD',
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     */
    public function aAuthRequireValidEmail()
    {
        $payload = [
            'email' => 'adminadmin',
            'password' => 'passwordSD',
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * @test
     */
    public function aAuthRequirePassword()
    {
        $payload = [
            'email' => 'admin@admin.com',
            'password' => '',
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertSessionHasErrors(['password']);
    }

    /**
     * @test
     */
    public function canSigninUser()
    {
        $payload = [
            "first_name" => "admin",
            "last_name"=> "Geral",
            "profile"=> "user",
            "email" => "admin@dasdasdaasdas.com",
            "document" => "aaaasdasdasda",
            "password" => "admin",
            "password_confirmation" => "admin",
        ];

        $response = $this->post('/api/auth/signin', $payload);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function cannotSigninInvalidProfile()
    {
        $payload = [
            "first_name" => "admin",
            "last_name"=> "Geral",
            "profile"=> "admin",
            "email" => "admin@dasdasdaasdas.com",
            "document" => "aaaasdasdasda",
            "password" => "admin",
            "password_confirmation" => "admin",
        ];

        $response = $this->post('/api/auth/signin', $payload);
        $response->assertSessionHasErrors(['profile']);
    }
}
