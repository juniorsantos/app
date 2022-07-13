<?php

declare(strict_types=1);

namespace Domains\User\Exceptions;

use Illuminate\Http\JsonResponse;

class InvalidEmailPasswordException extends \Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
                'message' => 'Invalid email or password',
        ], 422);
    }
}
