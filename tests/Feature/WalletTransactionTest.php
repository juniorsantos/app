<?php

namespace Tests\Feature;

use Domains\Transaction\Models\Wallet;
use Domains\User\Models\User;
use Tests\TestCase;

class WalletTransactionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRetailerShouldNotTransfer()
    {
        $userRetailer = $this->userRetailer();

        $payload = [
            'document' => '9090',
            'value' => 123
        ];

        $request = $this->actingAs($userRetailer)
            ->post('/api/transactions/transfer', $payload);
        $request
            ->assertStatus(422)
            ->assertJsonStructure(['message']);
    }

    public function testUserShouldTransferToRetailer()
    {
        $userRetailer = $this->userRetailer();
        $user = $this->user();

        $payload = [
            'document' => $userRetailer->document,
            'value' => 12
        ];

        $request = $this->actingAs($user)
            ->post('/api/transactions/transfer', $payload);
        $request
            ->assertStatus(201)
            ->assertJsonStructure(['uuid','balance']);
    }
    public function testUserShouldByFundsForTransferToRetailer()
    {
        $userRetailer = $this->userRetailer();
        $user = $this->user(0);

        $payload = [
            'document' => $userRetailer->document,
            'value' => 12
        ];

        $request = $this->actingAs($user)
            ->post('/api/transactions/transfer', $payload);
        $request
            ->assertStatus(422)
            ->assertJsonStructure(['message']);
    }

    public function testUserCanTransferMoney()
    {
        $userRetailer = $this->userRetailer();
        $user = $this->user();

        $payload = [
            'document' => $userRetailer->document,
            'value' => 1000
        ];

        $request = $this->actingAs($user)
            ->post('/api/transactions/transfer', $payload);
        $request
            ->assertStatus(201)
            ->assertJsonStructure(['uuid','balance']);
    }

    public function userRetailer()
    {
        $userRetailer = User::factory()->create([
            'first_name' => 'Retailer',
            'last_name' => 'Test',
            'profile' => 'retailer',
            'email' => 'retailer@test.com',
            'document' => '9090',
        ]);
        Wallet::factory()->create([
            'user_id' => $userRetailer->id,
            'balance' => 0,
        ]);

        return $userRetailer;
    }

    public function user($balance=3000)
    {
        $user = User::factory()->create([
            'first_name' => 'User',
            'last_name' => 'Test',
            'profile' => 'user',
            'email' => 'user@test.com',
            'document' => '9191',
        ]);
        Wallet::factory()->create([
            'user_id' => $user->id,
            'balance' => $balance,
        ]);
        return $user;
    }
}
