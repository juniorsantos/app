<?php

declare(strict_types=1);

namespace Domains\User\DataTransferObjects;

use App\Http\Requests\Users\StoreRequest;
use Infrastructure\Contracts\DTO\DataTransferObjectContract;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class UserData implements DataTransferObjectContract
{
    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $profile
     * @param string $email
     * @param string $document
     * @param string $password
     */
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $profile,
        public readonly string $email,
        public readonly string $document,
        public readonly string $password
    ){
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(StoreRequest $request): UserData
    {
        return new UserData(
            firstName: $request['first_name'],
            lastName: $request['last_name'],
            profile: $request['profile'],
            email: $request['email'],
            document: $request['document'],
            password: $request['password']
        );
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
