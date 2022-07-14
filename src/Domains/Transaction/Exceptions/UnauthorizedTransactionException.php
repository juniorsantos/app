<?php

declare(strict_types=1);

namespace Domains\Transaction\Exceptions;

use Illuminate\Http\JsonResponse;

class UnauthorizedTransactionException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
                'message' => 'Unauthorized transaction',
        ], 422);
    }
}
