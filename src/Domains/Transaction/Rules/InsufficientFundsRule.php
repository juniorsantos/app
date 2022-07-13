<?php

namespace Domains\Transaction\Rules;

use Closure;
use Domains\Transaction\Exceptions\InsufficientFundsException;

class InsufficientFundsRule
{
    /**
     * @throws InsufficientFundsException
     */
    public function handle($passable, Closure $next)
    {
        if($passable['payer_balance'] < $passable['value'] ) {
            throw new InsufficientFundsException();
        }

        return $next($passable);
    }
}
