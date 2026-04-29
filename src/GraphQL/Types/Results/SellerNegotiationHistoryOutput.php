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
        // The schema returns a union (SellerNegotiationHistoryOutput = SellerNegotiationHistorySuccess).
        // The query selects __typename + inline fragment, so $data contains the flattened
        // SellerNegotiationHistorySuccess fields at the top level.
        if (($data['__typename'] ?? null) !== null && ($data['__typename'] ?? null) !== 'SellerNegotiationHistorySuccess') {
            throw new \UnexpectedValueException(
                'Unknown __typename for SellerNegotiationHistoryOutput: ' . $data['__typename']
            );
        }

        return new self(
            itemNegotiations: array_map(
                fn(array $i) => ItemNegotiation::fromArray($i),
                $data['itemNegotiations'] ?? []
            ),
            pagination: Pagination::fromArray($data['pagination']),
        );
    }
}
