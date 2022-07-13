<?php

declare(strict_types=1);

namespace Domains\User\Providers;

use Domains\User\Repositories\UserEloquentRepository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Infrastructure\Contracts\UserRepositoryContract;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserEloquentRepository::class);
    }
}
