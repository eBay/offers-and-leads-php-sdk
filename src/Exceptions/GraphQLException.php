<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Exceptions;

class GraphQLException extends SdkException
{
    /** @param string[] $errors */
    public function __construct(
        private readonly array $errors,
        private readonly ?int $httpStatusCode = null,
        private readonly ?string $httpBody = null,
    ) {
        $message = $httpStatusCode !== null
            ? sprintf('HTTP %d: %s', $httpStatusCode, $httpBody ?? '')
            : 'GraphQL errors: ' . implode('; ', $errors);

        parent::__construct($message);
    }

    /**
     * Build an exception from a failed HTTP response (non-2xx).
     */
    public static function fromHttpError(int $statusCode, string $body): self
    {
        return new self([], $statusCode, $body);
    }

    /** @return string[] */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    public function getHttpBody(): ?string
    {
        return $this->httpBody;
    }
}
