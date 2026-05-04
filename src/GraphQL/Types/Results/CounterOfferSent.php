<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class CounterOfferSent extends CounterOfferOutput
{
    public function __construct(
        public NegotiationOfferDetails $offer,
    ) {}

    public function getTypename(): string
    {
        return 'CounterOfferSent';
    }

    public static function fromArray(array $data): self
    {
        return new self(
            offer: NegotiationOfferDetails::fromArray($data['offer']),
        );
    }
}
