<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class ConvertedAmount
{
    public function __construct(
        public Amount $original,
        public ?Amount $converted = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            original: Amount::fromArray($data['original']),
            converted: isset($data['converted']) ? Amount::fromArray($data['converted']) : null,
        );
    }
}
