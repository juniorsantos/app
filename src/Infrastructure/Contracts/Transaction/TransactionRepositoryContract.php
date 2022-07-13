<?php

declare(strict_types=1);

namespace Infrastructure\Contracts\Transaction;

interface TransactionRepositoryContract
{
    /**
     * @param $attribute
     * @param $value
     *
     * @return object|null
     */
    public function find($attribute, $value): ?object;

    /**
     * @param array $payload
     *
     * @return object|null
     */
    public function create(array $payload): ?object;
}
