<?php

declare(strict_types=1);

namespace Domains\Transaction\Exceptions;

use Illuminate\Http\JsonResponse;

class InsufficientFundsException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
                'message' => 'Insufficient funds.',
        ], 422);
    }
}
