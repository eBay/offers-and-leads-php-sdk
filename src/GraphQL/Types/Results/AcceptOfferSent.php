<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class AcceptOfferSent
{
    public function __construct(
        public NegotiationOfferDetails $offer,
        public ?array $purchaseReference = null,
    ) {}

    public function getTypename(): string
    {
        return 'AcceptOfferSent';
    }

    public static function fromArray(array $data): self
    {
        return new self(
            offer: NegotiationOfferDetails::fromArray($data['offer']),
            purchaseReference: $data['purchaseReference'] ?? null,
        );
    }
}
