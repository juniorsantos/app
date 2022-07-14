<?php

namespace Domains\Transaction\Repositories;

use Domains\Transaction\Events\SendNotificationEvent;
use Domains\Transaction\Exceptions\UnauthorizedTransactionException;
use Domains\Transaction\Models\Wallet;
use Domains\Transaction\Models\WalletTransaction;
use Domains\Transaction\Services\AuthorizationTransactionService;
use Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Infrastructure\Contracts\Transaction\TransactionRepositoryContract;

class TransactionEloquentRepository implements TransactionRepositoryContract
{
    public function __construct(
        protected User $userModel,
        protected Wallet $walletModel,
        protected WalletTransaction $walletTransactionModel
    ) {
    }

    /**
     * @param $document
     *
     * @return object|null
     */
    public function getPayeeByDocument($document): ?object
    {
        return $this->userModel->query()->whereDocument($document)->firstorFail();
    }

    /**
     * @param $userId
     *
     * @return object|null
     */
    public function getWalletByUserId($userId): ?object
    {
        return $this->walletModel->query()->whereUserId($userId)->first();
    }

    /**
     * @inheritDoc
     */
    public function create(array $payload): ?object
    {
        return DB::transaction(function () use ($payload) {
            $payeeWalletUuid = $this->userModel->query()
              ->whereUuid($payload['payee_uuid'])
              ->first()->wallet->uuid;
            $payerWalletUuid = Auth::user()->wallet->uuid;

            $transaction = $this->walletTransactionModel->query()->create([
              'payee_wallet_uuid' => $payeeWalletUuid,
              'payer_wallet_uuid' => $payerWalletUuid,
              'value' => $payload['value'],
          ]);

            if (!$this->isAuthorizeTransaction()) {
                throw new UnauthorizedTransactionException();
            }

            $transaction->walletPayer->withdraw($payload['value']);
            $transaction->walletPayee->deposit($payload['value']);

//          event(new SendNotificationEvent($transaction));

            return $transaction->walletPayer;
        });
    }

    public function isAuthorizeTransaction(): bool
    {
        $service = new AuthorizationTransactionService();
        return $service->authorize()['message']== 'Autorizado';
    }
}
