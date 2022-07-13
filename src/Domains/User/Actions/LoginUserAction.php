<?php

declare(strict_types=1);

namespace Domains\User\Actions;

use Domains\User\DataTransferObjects\AuthData;
use Domains\User\Exceptions\InvalidEmailPasswordException;
use Domains\User\Repositories\UserEloquentRepository;
use Illuminate\Support\Facades\Hash;

final class LoginUserAction
{
    public function __construct(
        protected UserEloquentRepository $repository
    ) {
    }

    /**
     * @throws InvalidEmailPasswordException
     */
    public function __invoke(AuthData $authData): array
    {
        $user = $this->repository->find(
            attribute: 'email',
            value: $authData->email
        );

        if (!$user || !Hash::check($authData->password, $user->password)) {
            throw new InvalidEmailPasswordException();
        }

        return [
            'user' => $user,
            'access_token' => $user->createToken('JWT')->plainTextToken,
        ];
    }
}
