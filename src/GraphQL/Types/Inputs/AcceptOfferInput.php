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

namespace EBay\OffersAndLeads\GraphQL\Types\Inputs;

readonly class AcceptOfferInput
{
    public function __construct(
        public string $itemId,
        public string $offerId,
        public ?string $message = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            itemId:  $data['itemId'],
            offerId: $data['offerId'],
            message: $data['message'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'itemId'  => $this->itemId,
            'offerId' => $this->offerId,
            'message' => $this->message,
        ], fn($v) => $v !== null);
    }
}
