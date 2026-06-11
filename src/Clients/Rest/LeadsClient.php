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

namespace EBay\OffersAndLeads\Clients\Rest;

use EBay\OffersAndLeads\Configuration\KiotaAuthProvider;
use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use EBay\OffersAndLeads\Configuration\RequestOptions;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Classified_leadRequestBuilderGetQueryParameters;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Classified_leadRequestBuilderGetRequestConfiguration;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Item\WithItemItemRequestBuilderGetQueryParameters;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Item\WithItemItemRequestBuilderGetRequestConfiguration;
use EBay\OffersAndLeads\Generated\SellLeads\Models\ClassifiedLeadsListResponse;
use EBay\OffersAndLeads\Generated\SellLeads\Models\ClassifiedLead;
use EBay\OffersAndLeads\Generated\SellLeads\SellLeadsApiClient;
use GuzzleHttp\Client as GuzzleClient;
use Microsoft\Kiota\Abstractions\Authentication\BaseBearerTokenAuthenticationProvider;
use Microsoft\Kiota\Http\GuzzleRequestAdapter;

final class LeadsClient
{
    public function __construct(
        private readonly GuzzleClient $guzzle,
        private readonly OffersAndLeadsConfiguration $config,
    ) {}

    /**
     * Retrieve all classified ad leads for the seller's active listings.
     *
     * @param  string|null         $startTime       ISO 8601 — only leads created on/after this time
     * @param  string|null         $endTime         ISO 8601 — only leads created on/before this time
     * @param  string|null         $status          'Answered' | 'Unanswered'
     * @param  string|null         $includeMessages 'true' | 'false'
     * @param  string|null         $accessToken     Per-call token; overrides config fallback
     * @param  RequestOptions|null $requestOptions  Per-call headers; merged over defaultRequestOptions
     * @return ClassifiedLeadsListResponse|null
     */
    public function getAllClassifiedLeads(
        ?string $startTime = null,
        ?string $endTime = null,
        ?string $status = null,
        ?string $includeMessages = null,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): ?ClassifiedLeadsListResponse {
        $headers = $this->mergedHeaders($requestOptions);

        $requestConfig = new Classified_leadRequestBuilderGetRequestConfiguration(
            headers: $headers ?: null,
            queryParameters: new Classified_leadRequestBuilderGetQueryParameters(
                endTime: $endTime,
                includeMessages: $includeMessages,
                startTime: $startTime,
                status: $status,
            )
        );

        return $this->call($accessToken, fn($api) =>
            $api->classified_lead()->get($requestConfig)->wait()
        );
    }

    /**
     * Retrieve classified ad leads for a specific listing.
     *
     * @param  string              $itemId          The unique listing identifier
     * @param  string|null         $startTime       ISO 8601 — only leads created on/after this time
     * @param  string|null         $endTime         ISO 8601 — only leads created on/before this time
     * @param  string|null         $status          'Answered' | 'Unanswered'
     * @param  string|null         $includeMessages 'true' | 'false' (default true for this endpoint)
     * @param  string|null         $accessToken     Per-call token; overrides config fallback
     * @param  RequestOptions|null $requestOptions  Per-call headers; merged over defaultRequestOptions
     * @return ClassifiedLead|null
     */
    public function getClassifiedLeadsByItemId(
        string $itemId,
        ?string $startTime = null,
        ?string $endTime = null,
        ?string $status = null,
        ?string $includeMessages = null,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): ?ClassifiedLead {
        $headers = $this->mergedHeaders($requestOptions);

        $requestConfig = new WithItemItemRequestBuilderGetRequestConfiguration(
            headers: $headers ?: null,
            queryParameters: new WithItemItemRequestBuilderGetQueryParameters(
                endTime: $endTime,
                includeMessages: $includeMessages,
                startTime: $startTime,
                status: $status,
            )
        );

        return $this->call($accessToken, fn($api) =>
            $api->classified_lead()->byItemId($itemId)->get($requestConfig)->wait()
        );
    }

    private function call(?string $accessToken, callable $op): mixed
    {
        $token = ($accessToken ?? $this->config->accessToken)
            ?: throw new \RuntimeException('No access token. Pass $accessToken per-call or set OffersAndLeadsConfiguration::$accessToken.');
        return $op($this->buildApiClient($token));
    }

    /**
     * Build a fresh per-call Kiota API client backed by the shared Guzzle instance.
     */
    private function buildApiClient(string $token): SellLeadsApiClient
    {
        $auth = new BaseBearerTokenAuthenticationProvider(
            new KiotaAuthProvider($token, $this->config->getAllowedHosts())
        );
        $adapter = new GuzzleRequestAdapter($auth, guzzleClient: $this->guzzle);
        $adapter->setBaseUrl($this->config->leadsBaseUrl);
        return new SellLeadsApiClient($adapter);
    }

    /** @return array<string,string> */
    private function mergedHeaders(?RequestOptions $requestOptions): array
    {
        return array_merge(
            $this->config->defaultRequestOptions->headers,
            $requestOptions?->headers ?? []
        );
    }
}
