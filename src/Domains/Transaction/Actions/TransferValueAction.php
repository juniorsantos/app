<?php

declare(strict_types=1);

namespace Domains\Transaction\Actions;

use Domains\Transaction\DataTransferObjects\TransferValueData;
use Domains\Transaction\Repositories\TransactionEloquentRepository;
use Domains\Transaction\Rules\CannotTransferYourselfRule;
use Domains\Transaction\Rules\InsufficientFundsRule;
use Domains\Transaction\Rules\PayeeDoesNotExistRule;
use Domains\Transaction\Rules\RetailerCannotTransferRule;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

final class TransferValueAction
{
    public function __construct(
        protected TransactionEloquentRepository $repository
    ) {
    }

    /**
     * @throws PayeeDoesNotExistException
     * @throws CannotTransferYourselfException
     */
    public function __invoke(TransferValueData $transferValueData): object
    {
        $data = $transferValueData->toArray();
        $payee = $this->repository->getPayeeByDocument($data['document']);
        $payer = Auth::user();
        $wallet = $this->repository->getWalletByUserId($payer->id);
        $passable = [
            'payee' => $payee,
            'payee_uuid' => $payee->uuid,
            'payer_uuid' => $payer->uuid,
            'payer_profile' => $payer->profile,
            'payer_balance' => $wallet?->balance,
            'value' => $data['value'],
        ];

        $this->executRules($passable);

        return $this->repository->create($passable);
    }

    public function executRules($passable): void
    {
        app(Pipeline::class)
            ->send($passable)
            ->through([
                RetailerCannotTransferRule::class,
                InsufficientFundsRule::class,
                PayeeDoesNotExistRule::class,
                CannotTransferYourselfRule::class,
            ])
            ->thenReturn();
    }
}
