<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

/**
 * Union: AcceptedOfferPurchaseReference = ItemCommitment
 */
readonly class PurchaseReference
{
    public function __construct(
        public string $typename,
        public ?string $itemCommitmentId = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            typename: $data['__typename'],
            itemCommitmentId: $data['itemCommitmentId'] ?? null,
        );
    }
}
