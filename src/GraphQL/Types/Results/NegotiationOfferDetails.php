<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class NegotiationOfferDetails
{
    public function __construct(
        public string $offerId,
        public string $status,
        public string $offerCreatorRole,
        public string $createdAt,
        public string $updatedAt,
        public int $quantity,
        public ConvertedAmount $offerPrice,
        public ?string $expiresAt = null,
        public ?string $message = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            offerId: $data['offerId'],
            status: $data['status'],
            offerCreatorRole: $data['offerCreatorRole'],
            createdAt: $data['createdAt'],
            updatedAt: $data['updatedAt'],
            quantity: $data['quantity'],
            offerPrice: ConvertedAmount::fromArray($data['offerPrice']),
            expiresAt: $data['expiresAt'] ?? null,
            message: $data['message'] ?? null,
        );
    }
}
