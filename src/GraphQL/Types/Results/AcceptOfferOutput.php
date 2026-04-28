<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

/**
 * Union: AcceptOfferSent | OfferBusinessRulesViolated | ReferenceArgumentsNotFound
 */
abstract readonly class AcceptOfferOutput
{
    abstract public function getTypename(): string;

    public static function fromArray(array $data): AcceptOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        return match ($data['__typename'] ?? null) {
            'AcceptOfferSent'            => AcceptOfferSent::fromArray($data),
            'OfferBusinessRulesViolated' => OfferBusinessRulesViolated::fromArray($data),
            'ReferenceArgumentsNotFound' => ReferenceArgumentsNotFound::fromArray($data),
            default => throw new \UnexpectedValueException(
                'Unknown __typename for AcceptOfferOutput: ' . ($data['__typename'] ?? 'null')
            ),
        };
    }
}
