<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class Amount
{
    public function __construct(
        public string $value,
        public ?string $currency = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            value: $data['value'],
            currency: $data['currency'] ?? null,
        );
    }
}
