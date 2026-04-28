<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Inputs;

readonly class SellerNegotiationHistoryInput
{
    public function __construct(
        public ?NegotiationHistoryFiltersInput $filters = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'filters' => $this->filters?->toArray(),
        ], fn($v) => $v !== null);
    }
}
