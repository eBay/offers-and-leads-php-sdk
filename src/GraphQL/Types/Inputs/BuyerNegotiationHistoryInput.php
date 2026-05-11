<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Inputs;

readonly class BuyerNegotiationHistoryInput
{
    public function __construct(
        public ?NegotiationHistoryFiltersInput $filters = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            filters: isset($data['filters']) ? NegotiationHistoryFiltersInput::fromArray($data['filters']) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'filters' => $this->filters?->toArray(),
        ], fn($v) => $v !== null);
    }
}
