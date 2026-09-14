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

readonly class Negotiation
{
    public function __construct(
        public ?string $negotiationId = null,
        /** @var NegotiationOfferDetails[] */
        public array $offers = [],
        public ?NegotiationOfferDetails $latestOffer = null,
        /** @var NegotiationOfferCapabilities[] */
        public array $offerCapabilities = [],
        public Item|null $target = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            negotiationId: $data['negotiationId'] ?? null,
            offers: array_map(fn($item) => NegotiationOfferDetails::fromArray($item), $data['offers'] ?? []),
            latestOffer: isset($data['latestOffer']) ? NegotiationOfferDetails::fromArray($data['latestOffer']) : null,
            offerCapabilities: array_map(fn($item) => NegotiationOfferCapabilities::fromArray($item), $data['offerCapabilities'] ?? []),
            target: isset($data['target']) ? OfferTarget::fromArray($data['target']) : null,
        );
    }
}
