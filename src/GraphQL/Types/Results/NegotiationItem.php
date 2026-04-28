<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class NegotiationItem
{
    public function __construct(
        public string $itemId,
        public string $title,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            itemId: $data['itemId'],
            title:  $data['title'],
        );
    }
}
