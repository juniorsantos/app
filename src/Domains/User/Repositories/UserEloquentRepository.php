<?php

declare(strict_types=1);

namespace Domains\User\Repositories;

use Domains\User\Models\User;
use Infrastructure\Contracts\User\UserRepositoryContract;

class UserEloquentRepository implements UserRepositoryContract
{
    public function __construct(
        protected User $model
    ) {
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return object|null
     */
    public function find($attribute, $value): ?object
    {
        return $this->model->query()->where($attribute, $value)->first();
    }

    public function create(array $payload): ?object
    {
        $user = $this->model->query()->create($payload);
        $user->wallet()->create([]);
        return $user;
    }
}
