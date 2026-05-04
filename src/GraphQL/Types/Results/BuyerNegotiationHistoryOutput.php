<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class BuyerNegotiationHistoryOutput
{
    /**
     * @param ItemNegotiation[] $itemNegotiations
     */
    public function __construct(
        public array $itemNegotiations,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            itemNegotiations: array_map(
                fn(array $i) => ItemNegotiation::fromArray($i),
                $data['itemNegotiations'] ?? []
            ),
        );
    }
}
