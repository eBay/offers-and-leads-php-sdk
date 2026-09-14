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

namespace EBay\OffersAndLeads\Clients\GraphQL;

use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use EBay\OffersAndLeads\Configuration\RequestOptions;
use EBay\OffersAndLeads\Exceptions\GraphQLException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

final class DynamicGraphQLClient
{
    public function __construct(
        private readonly ClientInterface $guzzle,
        private readonly OffersAndLeadsConfiguration $config,
    ) {}

    /**
     * Execute any GraphQL query or mutation.
     *
     * @param array<string, mixed> $variables
     * @return array<string, mixed> The `data` field of the GraphQL response.
     * @throws GraphQLException When the response contains GraphQL errors or an HTTP error occurs.
     */
    public function execute(string $query, array $variables = [], ?string $accessToken = null, ?RequestOptions $requestOptions = null): array
    {
        $token = ($accessToken ?? $this->config->accessToken)
            ?: throw new \RuntimeException(
                'No access token. Pass $accessToken per-call or set OffersAndLeadsConfiguration::$accessToken.'
            );

        $payload = ['query' => $query];
        if (!empty($variables)) {
            $payload['variables'] = $variables;
        }

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ];
        foreach ($this->config->defaultRequestOptions->headers as $key => $value) {
            if (!array_key_exists($key, $headers)) {
                $headers[$key] = $value;
            }
        }
        foreach ($requestOptions !== null ? $requestOptions->headers : [] as $key => $value) {
            if (!array_key_exists($key, $headers)) {
                $headers[$key] = $value;
            }
        }

        try {
            $response = $this->guzzle->request('POST', $this->config->graphQLBaseUrl, [
                'headers' => $headers,
                'json'    => $payload,
            ]);
        } catch (RequestException $e) {
            $status = $e->getResponse()?->getStatusCode() ?? 0;
            $body   = $e->getResponse()?->getBody()->getContents() ?? $e->getMessage();
            throw new GraphQLException(["HTTP $status: $body"]);
        }

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            $body = $response->getBody()->getContents();
            throw new GraphQLException(["HTTP $statusCode: $body"]);
        }

        $body = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        if (!empty($body['errors'])) {
            $messages = array_map(
                static fn(array $e): string => $e['message'] ?? 'Unknown GraphQL error',
                $body['errors']
            );
            throw new GraphQLException($messages);
        }

        return $body['data'] ?? [];
    }
}
