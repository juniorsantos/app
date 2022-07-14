<?php

declare(strict_types=1);

namespace Domains\Transaction\Exceptions;

use Illuminate\Http\JsonResponse;

class CannotTransferYourselfException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
                'message' => 'Cannot Transfer Yourself',
        ], 422);
    }
}
