<?php

declare(strict_types=1);

namespace Domains\User\Actions;

use Domains\User\DataTransferObjects\UserData;
use Domains\User\Exceptions\InvalidEmailPasswordException;
use Domains\User\Repositories\UserEloquentRepository;

final class CreateUserAction
{
    public function __construct(
        protected UserEloquentRepository $repository
    ) {
    }

    /**
     * @throws InvalidEmailPasswordException
     */
    public function __invoke(UserData $userData): object
    {
        return $this->repository->create($userData->toArray());
    }
}
