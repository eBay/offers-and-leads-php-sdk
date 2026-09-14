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

readonly class NegotiationHistoryFilters
{
    public function __construct(
        public ?string $activeAfter = null,
        public ?string $activeBefore = null,
        public ?string $negotiationCreatorRole = null,
        public ?PageInfoInput $pagination = null,
        public ?string $statusFilter = null,
    ) {}

    /** @param array<string, mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            activeAfter: $data['activeAfter'] ?? null,
            activeBefore: $data['activeBefore'] ?? null,
            negotiationCreatorRole: $data['negotiationCreatorRole'] ?? null,
            pagination: isset($data['pagination']) ? PageInfoInput::fromArray($data['pagination']) : null,
            statusFilter: $data['statusFilter'] ?? null,
        );
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return array_filter(
            [
                'activeAfter' => $this->activeAfter,
                'activeBefore' => $this->activeBefore,
                'negotiationCreatorRole' => $this->negotiationCreatorRole,
                'pagination' => $this->pagination !== null ? (object)$this->pagination->toArray() : null,
                'statusFilter' => $this->statusFilter,
            ],
            static fn($value) => $value !== null,
        );
    }
}
