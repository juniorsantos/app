<?php

declare(strict_types=1);

namespace Domains\Transaction\Exceptions;

use Illuminate\Http\JsonResponse;

class RetailerCannotTransferException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
                'message' => 'Retailer Cannot Transfer',
        ], 422);
    }
}
