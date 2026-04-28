<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class ItemNegotiation
{
    /**
     * @param array<string, mixed> $item  Raw item fields (id, title, etc.)
     * @param Negotiation[] $negotiations
     */
    public function __construct(
        public array $item,
        public array $negotiations,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            item: $data['item'] ?? [],
            negotiations: array_map(
                fn(array $n) => Negotiation::fromArray($n),
                $data['negotiations'] ?? []
            ),
        );
    }
}
