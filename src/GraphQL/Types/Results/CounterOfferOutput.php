<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

/**
 * Union: CounterOfferSent | OfferBusinessRulesViolated | ReferenceArgumentsNotFound
 */
abstract readonly class CounterOfferOutput
{
    abstract public function getTypename(): string;

    public static function fromArray(array $data): CounterOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        return match ($data['__typename'] ?? null) {
            'CounterOfferSent'           => CounterOfferSent::fromArray($data),
            'OfferBusinessRulesViolated' => OfferBusinessRulesViolated::fromArray($data),
            'ReferenceArgumentsNotFound' => ReferenceArgumentsNotFound::fromArray($data),
            default => throw new \UnexpectedValueException(
                'Unknown __typename for CounterOfferOutput: ' . ($data['__typename'] ?? 'null')
            ),
        };
    }
}
