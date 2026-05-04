<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class NegotiationOfferDetails
{
    public function __construct(
        public string $offerId,
        public string $status,
        public ?string $offerCreatorRole = null,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $quantity = null,
        public ?ConvertedAmount $offerPrice = null,
        public ?string $expiresAt = null,
        public ?string $message = null,
        /** @var array{shippingZone: array{postalCode: string|null}|null}|null */
        public ?array $offerCreatorUser = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            offerId: $data['offerId'],
            status: $data['status'],
            offerCreatorRole: $data['offerCreatorRole'] ?? null,
            createdAt: $data['createdAt'] ?? null,
            updatedAt: $data['updatedAt'] ?? null,
            quantity: $data['quantity'] ?? null,
            offerPrice: isset($data['offerPrice']) ? ConvertedAmount::fromArray($data['offerPrice']) : null,
            expiresAt: $data['expiresAt'] ?? null,
            message: $data['message'] ?? null,
            offerCreatorUser: $data['offerCreatorUser'] ?? null,
        );
    }
}
