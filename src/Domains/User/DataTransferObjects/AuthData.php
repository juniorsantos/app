<?php

declare(strict_types=1);

namespace Domains\User\DataTransferObjects;

use App\Http\Requests\Users\AuthRequest;
use Infrastructure\Contracts\DTO\DataTransferObjectContract;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class AuthData implements DataTransferObjectContract
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
      public readonly string $email,
      public readonly string $password,
    ){
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(AuthRequest $request): AuthData
    {
        return new AuthData($request['email'], $request['password']);
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
