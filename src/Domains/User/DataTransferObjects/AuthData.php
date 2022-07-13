<?php

declare(strict_types=1);

namespace Domains\User\DataTransferObjects;

use App\Http\Requests\Users\AuthRequest;
use Infrastructure\Contracts\DTO\DataTransferObjectContract;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthData extends DataTransferObject implements DataTransferObjectContract
{
    /** @var string */
    public string $email;

    /** @var string */
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(AuthRequest $request): AuthData
    {
        $payload = $request->validated();

        return new self([
            'email' => $payload['email'],
            'password' => $payload['password'],
        ]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
