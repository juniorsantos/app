<?php

namespace Tests\Unit\Domains\User\DataTransferObjects;

use App\Http\Requests\Users\AuthRequest;
use Domains\User\DataTransferObjects\AuthData;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Tests\TestCase;

class AuthDataTest extends TestCase
{
    /** @test
     * @throws UnknownProperties
     */
    public function formUserAuthRequest()
    {
        $dto = AuthData::fromRequest(new AuthRequest([
            'email' => 'test@test.com',
            'password' => 'password',
        ]));

        $this->assertInstanceOf(AuthData::class, $dto);
    }

    /** @test
     * @throws UnknownProperties
     */
    public function formUserAuthRequestToArray()
    {
        $dto = AuthData::fromRequest(new AuthRequest([
            'email' => 'test@test.com',
            'password' => 'password',
        ]))->toArray();

        $this->assertArrayHasKey('email', $dto);
        $this->assertArrayHasKey('password', $dto);
    }
}
