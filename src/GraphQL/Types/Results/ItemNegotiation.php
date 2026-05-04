<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class ItemNegotiation
{
    /**
     * @param Negotiation[] $negotiations
     */
    public function __construct(
        public array $negotiations,
        public ?NegotiationItem $item = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            negotiations: array_map(
                fn(array $n) => Negotiation::fromArray($n),
                $data['negotiations'] ?? []
            ),
            item: isset($data['item']) ? NegotiationItem::fromArray($data['item']) : null,
        );
    }
}
