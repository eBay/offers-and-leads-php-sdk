<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class Negotiation
{
    /**
     * @param NegotiationOfferDetails[] $offers
     * @param array{negotiable: bool|null}|null $offerCapabilities
     * @param array{itemId: string}|null $target  Inline fragment on Item
     */
    public function __construct(
        public string $negotiationId,
        public array $offers,
        public ?NegotiationOfferDetails $latestOffer = null,
        public ?array $offerCapabilities = null,
        public ?array $target = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            negotiationId: $data['negotiationId'],
            offers: array_map(
                fn(array $o) => NegotiationOfferDetails::fromArray($o),
                $data['offers'] ?? []
            ),
            latestOffer: isset($data['latestOffer']) ? NegotiationOfferDetails::fromArray($data['latestOffer']) : null,
            offerCapabilities: $data['offerCapabilities'] ?? null,
            target: $data['target'] ?? null,
        );
    }
}
