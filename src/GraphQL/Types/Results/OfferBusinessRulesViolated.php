<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class OfferBusinessRulesViolated
{
    /**
     * @param BusinessRuleViolation[] $violations
     */
    public function __construct(
        public string $errorCode,
        public string $errorMessage,
        public array $violations,
    ) {}

    public function getTypename(): string
    {
        return 'OfferBusinessRulesViolated';
    }

    public static function fromArray(array $data): self
    {
        return new self(
            errorCode: $data['errorCode'],
            errorMessage: $data['errorMessage'],
            violations: array_map(
                fn(array $v) => BusinessRuleViolation::fromArray($v),
                $data['violations'] ?? []
            ),
        );
    }
}
