<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class Negotiation
{
    /**
     * @param NegotiationOfferDetails[] $offers
     */
    public function __construct(
        public string $negotiationId,
        public NegotiationOfferDetails $latestOffer,
        public array $offers,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            negotiationId: $data['negotiationId'],
            latestOffer: NegotiationOfferDetails::fromArray($data['latestOffer']),
            offers: array_map(
                fn(array $o) => NegotiationOfferDetails::fromArray($o),
                $data['offers'] ?? []
            ),
        );
    }
}
