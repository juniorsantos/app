<?php

declare(strict_types=1);

namespace Infrastructure\Contracts\DTO;

interface DataTransferObjectContract
{
    /**
     * @return array
     */
    public function toArray(): array;
}
