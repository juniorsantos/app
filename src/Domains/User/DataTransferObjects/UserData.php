<?php

declare(strict_types=1);

namespace Domains\User\DataTransferObjects;

use App\Http\Requests\Users\AuthRequest;
use App\Http\Requests\Users\StoreRequest;
use Infrastructure\Contracts\DTO\DataTransferObjectContract;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserData extends DataTransferObject implements DataTransferObjectContract
{
    /** @var string */
    public string $firstName;

    /** @var string */
    public string $lastName;

    /** @var string */
    public string $profile;

    /** @var string */
    public string $email;

    /** @var string */
    public string $document;

    /** @var string */
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(StoreRequest $request): UserData
    {
        $payload = $request->validated();

        return new self([
            'firstName' => $payload['first_name'],
            'lastName' => $payload['last_name'],
            'profile' => $payload['profile'],
            'email' => $payload['email'],
            'document' => $payload['document'],
            'password' => $payload['password'],
        ]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'profile' => $this->profile,
            'email' => $this->email,
            'document' => $this->document,
            'password' => $this->password,
        ];
    }
}
