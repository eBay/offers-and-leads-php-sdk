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

readonly class User
{
    public function __construct(
        public ?string $userId = null,
        public ?string $username = null,
        public ?PrimaryShippingZone $shippingZone = null,
        public ?bool $newUser = null,
        public ?IndividualIdentityProfile $individualIdentityProfile = null,
        public ?string $userCreatedAt = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            userId: $data['userId'] ?? null,
            username: $data['username'] ?? null,
            shippingZone: isset($data['shippingZone']) ? PrimaryShippingZone::fromArray($data['shippingZone']) : null,
            newUser: $data['newUser'] ?? null,
            individualIdentityProfile: isset($data['individualIdentityProfile']) ? IndividualIdentityProfile::fromArray($data['individualIdentityProfile']) : null,
            userCreatedAt: $data['userCreatedAt'] ?? null,
        );
    }
}
