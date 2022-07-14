<?php

declare(strict_types=1);

namespace Infrastructure\Contracts\Transaction;

interface TransactionRepositoryContract
{
    /**
     * @param $document
     *
     * @return object|null
     */
    public function getPayeeByDocument($document): ?object;

    /**
     * @param $userId
     *
     * @return object|null
     */
    public function getWalletByUserId($userId): ?object;

    /**
     * @param array $payload
     *
     * @return object|null
     */
    public function create(array $payload): ?object;

    /**
     * @return bool
     */
    public function isAuthorizeTransaction(): bool;
}
