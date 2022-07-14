<?php

declare(strict_types=1);

namespace Domains\Transaction\Providers;

use Domains\Transaction\Repositories\TransactionEloquentRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Infrastructure\Contracts\Transaction\TransactionRepositoryContract;

class TransactionRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TransactionRepositoryContract::class, TransactionEloquentRepository::class);
    }
}
