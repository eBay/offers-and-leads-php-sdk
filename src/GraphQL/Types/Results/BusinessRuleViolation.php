<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class BusinessRuleViolation
{
    public function __construct(
        public string $ruleDescription,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            ruleDescription: $data['ruleDescription'],
        );
    }
}
