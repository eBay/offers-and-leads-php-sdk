<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

/**
 * Union: MakeOfferSent | OfferBusinessRulesViolated | ReferenceArgumentsNotFound
 */
abstract readonly class MakeOfferOutput
{
    abstract public function getTypename(): string;

    public static function fromArray(array $data): MakeOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        return match ($data['__typename'] ?? null) {
            'MakeOfferSent'              => MakeOfferSent::fromArray($data),
            'OfferBusinessRulesViolated' => OfferBusinessRulesViolated::fromArray($data),
            'ReferenceArgumentsNotFound' => ReferenceArgumentsNotFound::fromArray($data),
            default => throw new \UnexpectedValueException(
                'Unknown __typename for MakeOfferOutput: ' . ($data['__typename'] ?? 'null')
            ),
        };
    }
}
