<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class DeclineOfferSent extends DeclineOfferOutput
{
    public function __construct(
        public NegotiationOfferDetails $offer,
    ) {}

    public function getTypename(): string
    {
        return 'DeclineOfferSent';
    }

    public static function fromArray(array $data): self
    {
        return new self(
            offer: NegotiationOfferDetails::fromArray($data['offer']),
        );
    }
}
