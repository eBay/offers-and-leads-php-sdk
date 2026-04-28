<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Inputs;

readonly class AcceptOfferInput
{
    public function __construct(
        public string $itemId,
        public string $offerId,
        public ?string $message = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'itemId'  => $this->itemId,
            'offerId' => $this->offerId,
            'message' => $this->message,
        ], fn($v) => $v !== null);
    }
}
