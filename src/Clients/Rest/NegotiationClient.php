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
use EBay\OffersAndLeads\Generated\Negotiation\NegotiationApiClient;
use EBay\OffersAndLeads\Generated\Negotiation\Models\CreateOffersRequest;
use EBay\OffersAndLeads\Generated\Negotiation\Models\PagedEligibleItemCollection;
use EBay\OffersAndLeads\Generated\Negotiation\Models\SendOfferToInterestedBuyersCollectionResponse;
use GuzzleHttp\Client as GuzzleClient;
use Microsoft\Kiota\Abstractions\Authentication\BaseBearerTokenAuthenticationProvider;
use Microsoft\Kiota\Http\GuzzleRequestAdapter;

final class NegotiationClient
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

    public function findEligibleItems(
        ?int $limit = null,
        ?int $offset = null,
        ?string $xEBAYCMARKETPLACEID = null,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): ?PagedEligibleItemCollection
    {
        $headers = $this->mergedHeaders($requestOptions);
        if ($xEBAYCMARKETPLACEID !== null) {
            $headers["X-EBAY-C-MARKETPLACE-ID"] = $xEBAYCMARKETPLACEID;
        }
        return $this->call($accessToken, fn($api) =>
            $api->find_eligible_items()->get(
                new \EBay\OffersAndLeads\Generated\Negotiation\Find_eligible_items\Find_eligible_itemsRequestBuilderGetRequestConfiguration(
                    headers: $headers,
                    queryParameters: \EBay\OffersAndLeads\Generated\Negotiation\Find_eligible_items\Find_eligible_itemsRequestBuilderGetRequestConfiguration::createQueryParameters(
                        limit: $limit,
                        offset: $offset,
                    ),
                )
            )->wait()
        );
    }

    public function sendOfferToInterestedBuyers(
        CreateOffersRequest $body,
        ?string $xEBAYCMARKETPLACEID = null,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): ?SendOfferToInterestedBuyersCollectionResponse
    {
        $headers = $this->mergedHeaders($requestOptions);
        if ($xEBAYCMARKETPLACEID !== null) {
            $headers["X-EBAY-C-MARKETPLACE-ID"] = $xEBAYCMARKETPLACEID;
        }
        return $this->call($accessToken, fn($api) =>
            $api->send_offer_to_interested_buyers()->post(
                $body,
                new \EBay\OffersAndLeads\Generated\Negotiation\Send_offer_to_interested_buyers\Send_offer_to_interested_buyersRequestBuilderPostRequestConfiguration(headers: $headers)
            )->wait()
        );
    }

    private function call(?string $accessToken, callable $op): mixed
    {
        $token = ($accessToken ?? $this->config->accessToken)
            ?: throw new \RuntimeException('No access token. Pass $accessToken per-call or set OffersAndLeadsConfiguration::$accessToken.');
        return $op($this->buildApiClient($token));
    }

    private function buildApiClient(string $token): NegotiationApiClient
    {
        $auth = new BaseBearerTokenAuthenticationProvider(
            new KiotaAuthProvider($token, $this->config->getAllowedHosts())
        );
        $adapter = new GuzzleRequestAdapter($auth, guzzleClient: $this->guzzle);
        $adapter->setBaseUrl($this->config->negotiationBaseUrl);
        return new NegotiationApiClient($adapter);
    }
}
