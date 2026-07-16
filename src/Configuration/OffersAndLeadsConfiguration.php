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

final class OffersAndLeadsConfiguration
{
    public readonly RequestOptions $defaultRequestOptions;

    public function __construct(
        public readonly string  $leadsBaseUrl      = 'https://apiz.ebay.com/sell/leads/v1',
        public readonly string  $graphQLBaseUrl    = 'https://api.ebay.com/graphql',
        public readonly ?string $accessToken       = null,
        public readonly bool    $diagnosticLogging = false,
    ) {
        $this->defaultRequestOptions = new RequestOptions();
    }

    public function __debugInfo(): array
    {
        return array_merge(get_object_vars($this), [
            'accessToken' => $this->accessToken !== null ? '***' : null,
        ]);
    }

    /**
     * Hostnames tokens may be sent to — passed to AllowedHostsValidator.
     *
     * @return string[]
     */
    public function getAllowedHosts(): array
    {
        return array_values(array_unique(array_filter(array_map(
            fn(string $url) => parse_url($url, PHP_URL_HOST),
            [$this->leadsBaseUrl, $this->graphQLBaseUrl]
        ), 'is_string')));
    }
}
