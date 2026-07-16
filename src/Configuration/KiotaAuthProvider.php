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

namespace EBay\OffersAndLeads\Configuration;

use Http\Promise\FulfilledPromise;
use Http\Promise\Promise;
use Microsoft\Kiota\Abstractions\Authentication\AccessTokenProvider;
use Microsoft\Kiota\Abstractions\Authentication\AllowedHostsValidator;

final class KiotaAuthProvider implements AccessTokenProvider
{
    private readonly AllowedHostsValidator $allowedHostsValidator;

    public function __construct(
        private readonly string $token,
        array $allowedHosts,
    ) {
        $this->allowedHostsValidator = new AllowedHostsValidator($allowedHosts);
    }

    public function getAuthorizationTokenAsync(string $url, array $additionalAuthenticationContext = []): Promise
    {
        return new FulfilledPromise($this->token);
    }

    public function getAllowedHostsValidator(): AllowedHostsValidator
    {
        return $this->allowedHostsValidator;
    }

    public function __debugInfo(): array
    {
        return [
            'token'                 => '***',
            'allowedHostsValidator' => $this->allowedHostsValidator,
        ];
    }
}
