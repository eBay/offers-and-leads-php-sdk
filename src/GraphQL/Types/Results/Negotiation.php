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
