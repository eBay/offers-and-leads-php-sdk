<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

/**
 * Union: DeclineOfferSent | OfferBusinessRulesViolated | ReferenceArgumentsNotFound
 */
abstract class DeclineOfferOutput
{
    abstract public function getTypename(): string;

    public static function fromArray(array $data): DeclineOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        return match ($data['__typename'] ?? null) {
            'DeclineOfferSent'           => DeclineOfferSent::fromArray($data),
            'OfferBusinessRulesViolated' => OfferBusinessRulesViolated::fromArray($data),
            'ReferenceArgumentsNotFound' => ReferenceArgumentsNotFound::fromArray($data),
            default => throw new \UnexpectedValueException(
                'Unknown __typename for DeclineOfferOutput: ' . ($data['__typename'] ?? 'null')
            ),
        };
    }
}
