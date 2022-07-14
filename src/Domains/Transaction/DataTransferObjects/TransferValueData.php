<?php

declare(strict_types=1);

namespace Domains\Transaction\DataTransferObjects;

use App\Http\Requests\Transactions\TransferValueRequest;
use Infrastructure\Contracts\DTO\DataTransferObjectContract;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class TransferValueData implements DataTransferObjectContract
{
    /**
     * @param string $document
     * @param float $value
     */
    public function __construct(
        public readonly string $document,
        public readonly float $value,
    ) {
    }

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(TransferValueRequest $request): TransferValueData
    {
        $payload = $request->validated();

        return new TransferValueData($payload['document'], $payload['value']);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'document' => $this->document,
            'value' => $this->value,
        ];
    }
}
