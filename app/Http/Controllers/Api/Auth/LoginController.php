<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AuthRequest;
use Domains\User\Actions\LoginUserAction;
use Domains\User\DataTransferObjects\AuthData;
use Domains\User\Exceptions\InvalidEmailPasswordException;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginController extends Controller
{
    /**
     * @throws UnknownProperties
     * @throws InvalidEmailPasswordException
     */
    public function __invoke(AuthRequest $request, LoginUserAction $action): JsonResponse
    {
        $payload = AuthData::fromRequest($request);
        $data = $action($payload);

        return new JsonResponse(
            data: $data,
            status: 200,
        );
    }
}
