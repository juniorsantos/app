<?php

namespace Domains\Transaction\Rules;

use Closure;
use Domains\Transaction\Exceptions\CannotTransferYourselfException;

class CannotTransferYourselfRule
{
    /**
     * @throws CannotTransferYourselfException
     */
    public function handle($passable, Closure $next)
    {
        if ($passable['payee_uuid']===$passable['payer_uuid']) {
            throw new CannotTransferYourselfException();
        }
        return $next($passable);
    }
}
