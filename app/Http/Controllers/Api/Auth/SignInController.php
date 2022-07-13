<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use Domains\User\Actions\CreateUserAction;
use Domains\User\DataTransferObjects\UserData;
use Domains\User\Exceptions\InvalidEmailPasswordException;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class SignInController extends Controller
{
    /**
     * @throws UnknownProperties
     * @throws InvalidEmailPasswordException
     */
    public function __invoke(StoreRequest $request, CreateUserAction $action): JsonResponse
    {
        $payload = UserData::fromRequest($request);
        $data = $action($payload);

        return new JsonResponse(
            data: $data,
            status: 201,
        );
    }
}
