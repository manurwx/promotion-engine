<?php
declare(strict_types=1);

namespace App\Service;

class ServiceExceptionData
{
    public function __construct(protected int $statusCode, protected string $type)
    {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function toArray(): array
    {
        return ['type' => $this->type];
    }
}