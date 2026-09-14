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
        public ?string $offerId = null,
        public ?string $status = null,
        public ?string $offerCreatorRole = null,
        public ?User $offerCreatorUser = null,
        public ?int $quantity = null,
        public ?string $updatedAt = null,
        public ?string $createdAt = null,
        public ?string $expiresAt = null,
        public ?string $message = null,
        public ?ConvertedAmount $offerPrice = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            offerId: $data['offerId'] ?? null,
            status: $data['status'] ?? null,
            offerCreatorRole: $data['offerCreatorRole'] ?? null,
            offerCreatorUser: isset($data['offerCreatorUser']) ? User::fromArray($data['offerCreatorUser']) : null,
            quantity: $data['quantity'] ?? null,
            updatedAt: $data['updatedAt'] ?? null,
            createdAt: $data['createdAt'] ?? null,
            expiresAt: $data['expiresAt'] ?? null,
            message: $data['message'] ?? null,
            offerPrice: isset($data['offerPrice']) ? ConvertedAmount::fromArray($data['offerPrice']) : null,
        );
    }
}
