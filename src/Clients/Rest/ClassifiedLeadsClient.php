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
use EBay\OffersAndLeads\Generated\ClassifiedLeads\ClassifiedLeadsApiClient;
use EBay\OffersAndLeads\Generated\ClassifiedLeads\Models\ClassifiedLead;
use EBay\OffersAndLeads\Generated\ClassifiedLeads\Models\ClassifiedLeadsListResponse;
use GuzzleHttp\Client as GuzzleClient;
use Microsoft\Kiota\Abstractions\Authentication\BaseBearerTokenAuthenticationProvider;
use Microsoft\Kiota\Http\GuzzleRequestAdapter;

final class ClassifiedLeadsClient
{
    public function __construct(
        private readonly GuzzleClient $guzzle,
        private readonly OffersAndLeadsConfiguration $config,
    ) {}

    /** @return array<string, string> */
    private function mergedHeaders(?RequestOptions $requestOptions): array
    {
        return array_merge(
            $this->config->defaultRequestOptions->headers,
            $requestOptions !== null ? $requestOptions->headers : []
        );
    }

    public function getAllClassifiedLeads(
        ?string $endTime = null,
        ?string $includeMessages = null,
        ?string $startTime = null,
        ?string $status = null,
        ?string $acceptEncoding = null,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): ?ClassifiedLeadsListResponse
    {
        $headers = $this->mergedHeaders($requestOptions);
        if ($acceptEncoding !== null) {
            $headers["Accept-Encoding"] = $acceptEncoding;
        }
        return $this->call($accessToken, fn($api) =>
            $api->classified_lead()->get(
                new \EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead\Classified_leadRequestBuilderGetRequestConfiguration(
                    headers: $headers,
                    queryParameters: \EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead\Classified_leadRequestBuilderGetRequestConfiguration::createQueryParameters(
                        endTime: $endTime,
                        includeMessages: $includeMessages,
                        startTime: $startTime,
                        status: $status,
                    ),
                )
            )->wait()
        );
    }

    public function getClassifiedLeadsByItemId(
        string $itemId,
        ?string $endTime = null,
        ?string $includeMessages = null,
        ?string $startTime = null,
        ?string $status = null,
        ?string $acceptEncoding = null,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): ?ClassifiedLead
    {
        $headers = $this->mergedHeaders($requestOptions);
        if ($acceptEncoding !== null) {
            $headers["Accept-Encoding"] = $acceptEncoding;
        }
        return $this->call($accessToken, fn($api) =>
            $api->classified_lead()->byItemId($itemId)->get(
                new \EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead\Item\WithItemItemRequestBuilderGetRequestConfiguration(
                    headers: $headers,
                    queryParameters: \EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead\Item\WithItemItemRequestBuilderGetRequestConfiguration::createQueryParameters(
                        endTime: $endTime,
                        includeMessages: $includeMessages,
                        startTime: $startTime,
                        status: $status,
                    ),
                )
            )->wait()
        );
    }

    private function call(?string $accessToken, callable $op): mixed
    {
        $token = ($accessToken ?? $this->config->accessToken)
            ?: throw new \RuntimeException('No access token. Pass $accessToken per-call or set OffersAndLeadsConfiguration::$accessToken.');
        return $op($this->buildApiClient($token));
    }

    private function buildApiClient(string $token): ClassifiedLeadsApiClient
    {
        $auth = new BaseBearerTokenAuthenticationProvider(
            new KiotaAuthProvider($token, $this->config->getAllowedHosts())
        );
        $adapter = new GuzzleRequestAdapter($auth, guzzleClient: $this->guzzle);
        $adapter->setBaseUrl($this->config->classifiedLeadsBaseUrl);
        return new ClassifiedLeadsApiClient($adapter);
    }
}
