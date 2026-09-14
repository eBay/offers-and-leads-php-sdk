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

readonly class IndividualIdentityProfile
{
    public function __construct(
        public ?string $email = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $middleName = null,
        public ?Phone $primaryPhone = null,
        public ?ProfileAddress $profileAddress = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'] ?? null,
            firstName: $data['firstName'] ?? null,
            lastName: $data['lastName'] ?? null,
            middleName: $data['middleName'] ?? null,
            primaryPhone: isset($data['primaryPhone']) ? Phone::fromArray($data['primaryPhone']) : null,
            profileAddress: isset($data['profileAddress']) ? ProfileAddress::fromArray($data['profileAddress']) : null,
        );
    }
}
