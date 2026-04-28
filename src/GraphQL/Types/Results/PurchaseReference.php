<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

/**
 * Union: AcceptedOfferPurchaseReference = ItemCommitment
 *
 * Only __typename is requested in the current query fragment.
 * Extend this class or add fields if the query is expanded.
 */
readonly class PurchaseReference
{
    public function __construct(
        public string $typename,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            typename: $data['__typename'],
        );
    }
}
