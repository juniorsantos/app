<?php

namespace Tests\Unit\Domains\User\DataTransferObjects;

use App\Http\Requests\Users\StoreRequest;
use Domains\User\DataTransferObjects\UserData;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Tests\TestCase;

class UserDataTest extends TestCase
{
    /** @test
     * @throws UnknownProperties
     */
    public function formUserStoreRequest()
    {
        $dto = UserData::fromRequest(new StoreRequest([
            'first_name' => 'user',
            'last_name' => 'test',
            'profile' => 'user',
            'email' => 'test@test.com',
            'document' => '9090909090',
            'password' => 'test@password',
        ]));

        $this->assertInstanceOf(UserData::class, $dto);
    }

    /** @test
     * @throws UnknownProperties
     */
    public function formUserAuthRequestToArray()
    {
        $dto = UserData::fromRequest(new StoreRequest([
            'first_name' => 'user',
            'last_name' => 'test',
            'profile' => 'user',
            'email' => 'test@test.com',
            'document' => '9090909090',
            'password' => 'test@password',
        ]))->toArray();

        $this->assertArrayHasKey('first_name', $dto);
        $this->assertArrayHasKey('last_name', $dto);
        $this->assertArrayHasKey('profile', $dto);
        $this->assertArrayHasKey('email', $dto);
        $this->assertArrayHasKey('document', $dto);
        $this->assertArrayHasKey('password', $dto);
    }
}
