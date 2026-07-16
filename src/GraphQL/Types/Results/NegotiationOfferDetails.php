<?php

// Copyright 2026 eBay Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

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

    /** @param array<mixed> $data */
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
