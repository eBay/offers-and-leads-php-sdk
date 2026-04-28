<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class ItemNegotiation
{
    /**
     * @param Negotiation[] $negotiations
     */
    public function __construct(
        public NegotiationItem $item,
        public array $negotiations,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            item: NegotiationItem::fromArray($data['item']),
            negotiations: array_map(
                fn(array $n) => Negotiation::fromArray($n),
                $data['negotiations'] ?? []
            ),
        );
    }
}
