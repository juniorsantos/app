<?php

namespace Domains\Transaction\Rules;

use Closure;
use Domains\Transaction\Exceptions\RetailerCannotTransferException;
use Domains\User\Enums\Profile;

class RetailerCannotTransferRule
{
    /**
     * @throws RetailerCannotTransferException
     */
    public function handle($passable, Closure $next)
    {
        if ($passable['payer_profile']===Profile::RETAILER->value) {
            throw new RetailerCannotTransferException();
        }
        return $next($passable);
    }
}
