<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Inputs;

readonly class MakeOfferInput
{
    /**
     * @param array{value: string, currency: string} $proposedPrice
     */
    public function __construct(
        public string $itemId,
        public array $proposedPrice,
        public ?int $quantity = null,
        public ?string $message = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'itemId'        => $this->itemId,
            'proposedPrice' => $this->proposedPrice,
            'quantity'      => $this->quantity,
            'message'       => $this->message,
        ], fn($v) => $v !== null);
    }
}
