<?php

namespace Domains\Transaction\Rules;

use Closure;
use Domains\Transaction\Exceptions\PayeeDoesNotExistException;

class PayeeDoesNotExistRule
{
    /**
     * @throws PayeeDoesNotExistException
     */
    public function handle($passable, Closure $next)
    {
        if (!$passable['payee']) {
            throw new PayeeDoesNotExistException();
        }
        return $next($passable);
    }
}
