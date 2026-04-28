<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Types\Results;

readonly class ReferenceArgumentsNotFound
{
    /**
     * @param string[] $argumentNames
     */
    public function __construct(
        public string $errorCode,
        public string $errorMessage,
        public array $argumentNames,
    ) {}

    public function getTypename(): string
    {
        return 'ReferenceArgumentsNotFound';
    }

    public static function fromArray(array $data): self
    {
        return new self(
            errorCode: $data['errorCode'],
            errorMessage: $data['errorMessage'],
            argumentNames: $data['argumentNames'] ?? [],
        );
    }
}
