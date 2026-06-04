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

namespace EBay\OffersAndLeads;

use EBay\OffersAndLeads\Clients\GraphQL\DynamicGraphQLClient;
use EBay\OffersAndLeads\Clients\GraphQL\OffersGraphQLClient;
use EBay\OffersAndLeads\Clients\Rest\LeadsClient;
use EBay\OffersAndLeads\Configuration\KiotaAuthProvider;
use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use EBay\OffersAndLeads\Generated\SellLeads\SellLeadsApiClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Microsoft\Kiota\Abstractions\Authentication\BaseBearerTokenAuthenticationProvider;
use Microsoft\Kiota\Http\GuzzleRequestAdapter;
use Psr\Http\Message\RequestInterface;

final class OffersAndLeadsClient
{
    /** REST: Classified Leads API */
    public readonly LeadsClient $leads;

    /** GraphQL: acceptOffer, declineOffer, sellerNegotiationHistory */
    public readonly OffersGraphQLClient $offers;

    public function __construct(
        OffersAndLeadsConfiguration $config,
        ?GuzzleClient $guzzle = null,
    ) {
        $guzzle ??= $this->buildGuzzle($config);

        $auth = new BaseBearerTokenAuthenticationProvider(new KiotaAuthProvider($config));

        // REST — Classified Leads
        $leadsAdapter = new GuzzleRequestAdapter($auth, guzzleClient: $guzzle);
        $leadsAdapter->setBaseUrl($config->leadsBaseUrl);
        $this->leads = new LeadsClient(new SellLeadsApiClient($leadsAdapter), $config);

        // GraphQL — Offers & Negotiation History
        $this->offers = new OffersGraphQLClient(
            new DynamicGraphQLClient($guzzle, $config)
        );
    }

    private function buildGuzzle(OffersAndLeadsConfiguration $config): GuzzleClient
    {
        $stack = HandlerStack::create();

        if ($config->diagnosticLogging) {
            $stack->push(Middleware::tap(
                before: static function (RequestInterface $request): void {
                    error_log(sprintf(
                        '[OffersAndLeads] --> %s %s',
                        $request->getMethod(),
                        str_replace(["\r", "\n"], ' ', (string) $request->getUri()),
                    ));
                },
                after: static function (RequestInterface $request, array $options, mixed $response): void {
                    // $response is a GuzzleHttp promise; log the settled value when available
                    if (is_object($response) && method_exists($response, 'then')) {
                        $response->then(static function (mixed $res) use ($request): void {
                            $status = method_exists($res, 'getStatusCode') ? $res->getStatusCode() : '?';
                            error_log(sprintf('[OffersAndLeads] <-- %s %s', $status, str_replace(["\r", "\n"], ' ', (string) $request->getUri())));
                        });
                    }
                },
            ), 'diagnosticLogging');
        }

        return new GuzzleClient([
            'handler'         => $stack,
            'timeout'         => 30,
            'connect_timeout' => 5,
        ]);
    }
}
