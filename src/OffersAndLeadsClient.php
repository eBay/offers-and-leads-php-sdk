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
use EBay\OffersAndLeads\Clients\Rest\ClassifiedLeadsClient;
use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Main entry point for the eBay Offers and Leads PHP SDK.
 */
final class OffersAndLeadsClient
{
    public readonly ClassifiedLeadsClient $classifiedLeads;
    public readonly OffersGraphQLClient $offers;

    public function __construct(
        OffersAndLeadsConfiguration $config,
        ?GuzzleClient $guzzle = null,
    ) {
        $guzzle ??= $this->buildGuzzle($config);

        $this->classifiedLeads = new ClassifiedLeadsClient($guzzle, $config);

        $this->offers = new OffersGraphQLClient(
            new DynamicGraphQLClient($guzzle, $config)
        );
    }

    /**
     * Build a Guzzle client with optional diagnostic logging middleware.
     * When $config->diagnosticLogging is true, all non-2xx responses are
     * logged to STDERR with method, URI, status code, and response body.
     */
    private function buildGuzzle(OffersAndLeadsConfiguration $config): GuzzleClient
    {
        $stack = HandlerStack::create();

        if ($config->diagnosticLogging) {
            $stack->push(static function (callable $handler): callable {
                return static function (RequestInterface $request, array $options) use ($handler): mixed {
                    return $handler($request, $options)->then(
                        static function (ResponseInterface $response) use ($request): ResponseInterface {
                            $status = $response->getStatusCode();
                            if ($status < 200 || $status >= 300) {
                                $body = (string) $response->getBody();
                                fwrite(
                                    STDERR,
                                    sprintf(
                                        "[OffersAndLeadsSDK] %s %s -> HTTP %d\n%s\n",
                                        $request->getMethod(),
                                        str_replace(["\r", "\n"], ' ', (string) $request->getUri()),
                                        $status,
                                        $body
                                    )
                                );
                            }
                            return $response;
                        }
                    );
                };
            });
        }

        return new GuzzleClient([
            'handler'         => $stack,
            'timeout'         => 30,
            'connect_timeout' => 5,
        ]);
    }
}
