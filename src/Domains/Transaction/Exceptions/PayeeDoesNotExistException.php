<?php

declare(strict_types=1);

namespace Domains\Transaction\Exceptions;

use Illuminate\Http\JsonResponse;

class PayeeDoesNotExistException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
                'message' => 'Payee does not exist',
        ], 422);
    }
}
