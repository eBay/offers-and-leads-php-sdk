<?php

// Copyright 2026 eBay Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

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
