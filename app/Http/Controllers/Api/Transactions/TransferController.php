<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\TransferValueRequest;
use Domains\Transaction\DataTransferObjects\TransferValueData;
use Domains\Transaction\Actions\TransferValueAction;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TransferController extends Controller
{
    /**
     * @param TransferValueRequest $request
     * @param TransferValueAction  $action
     *
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function __invoke(TransferValueRequest $request, TransferValueAction $action): JsonResponse
    {
        $payload = TransferValueData::fromRequest($request);
        $data = $action($payload);

        return new JsonResponse(
            data: $data,
            status: 201,
        );
    }
}
