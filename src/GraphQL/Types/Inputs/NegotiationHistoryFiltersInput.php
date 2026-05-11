<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Inputs;

/**
 * Filters for sellerNegotiationHistory.
 * All fields optional — server defaults: last 90 days, ACTIONABLE status, BUYER initiator.
 *
 * @param string|null $activeAfter  ISO 8601 DateTime — return negotiations active on/after this time
 * @param string|null $activeBefore ISO 8601 DateTime — return negotiations active on/before this time
 * @param string|null $negotiationCreatorRole ALL|BUYER|SELLER (default: BUYER)
 * @param string|null $statusFilter  ACTIONABLE|ALL|ACCEPTED|DECLINED|EXPIRED|COMPLETED (default: ACTIONABLE)
 */
readonly class NegotiationHistoryFiltersInput
{
    public function __construct(
        public ?string $activeAfter = null,
        public ?string $activeBefore = null,
        public ?string $negotiationCreatorRole = null,
        public ?PageInfoInput $pagination = null,
        public ?string $statusFilter = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            activeAfter:            $data['activeAfter'] ?? null,
            activeBefore:           $data['activeBefore'] ?? null,
            negotiationCreatorRole: $data['negotiationCreatorRole'] ?? null,
            pagination:             isset($data['pagination']) ? PageInfoInput::fromArray($data['pagination']) : null,
            statusFilter:           $data['statusFilter'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'activeAfter'             => $this->activeAfter,
            'activeBefore'            => $this->activeBefore,
            'negotiationCreatorRole'  => $this->negotiationCreatorRole,
            'pagination'              => $this->pagination !== null ? (object)$this->pagination->toArray() : null,
            'statusFilter'            => $this->statusFilter,
        ], fn($v) => $v !== null);
    }
}
