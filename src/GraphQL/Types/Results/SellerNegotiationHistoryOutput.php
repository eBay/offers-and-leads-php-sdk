<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class SellerNegotiationHistoryOutput
{
    /**
     * @param ItemNegotiation[] $itemNegotiations
     */
    public function __construct(
        public array $itemNegotiations,
        public Pagination $pagination,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            itemNegotiations: array_map(
                fn(array $i) => ItemNegotiation::fromArray($i),
                $data['itemNegotiations'] ?? []
            ),
            pagination: Pagination::fromArray($data['pagination']),
        );
    }
}
