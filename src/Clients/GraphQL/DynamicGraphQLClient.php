<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Clients\GraphQL;

use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use EBay\OffersAndLeads\Configuration\RequestOptions;
use EBay\OffersAndLeads\Configuration\TokenContext;
use EBay\OffersAndLeads\Exceptions\GraphQLException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;

final class DynamicGraphQLClient
{
    public function __construct(
        private readonly ClientInterface $guzzle,
        private readonly OffersAndLeadsConfiguration $config,
    ) {}

    /**
     * Execute any GraphQL query or mutation.
     *
     * @param  array<string, mixed> $variables
     * @param  RequestOptions|null  $requestOptions Per-call headers merged over defaultRequestOptions
     * @return array<string, mixed>  The `data` field of the GraphQL response.
     * @throws GraphQLException      On HTTP errors or GraphQL-level errors in the response.
     */
    public function execute(
        string $query,
        array $variables = [],
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): array {
        $token = $accessToken ?? TokenContext::get() ?? $this->config->accessToken
            ?? throw new \RuntimeException(
                'No access token. Pass $accessToken or set OffersAndLeadsConfiguration::$accessToken.'
            );

        $headers = $this->buildHeaders($token, $requestOptions);

        try {
            $response = $this->guzzle->request('POST', $this->config->graphQLBaseUrl, [
                'headers' => $headers,
                'json'    => array_filter(['query' => $query, 'variables' => $variables ?: null]),
            ]);
        } catch (BadResponseException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $body       = $e->getResponse()->getBody()->getContents();
            throw GraphQLException::fromHttpError($statusCode, $body);
        }

        $statusCode = $response->getStatusCode();
        $rawBody    = $response->getBody()->getContents();

        if ($statusCode < 200 || $statusCode >= 300) {
            throw GraphQLException::fromHttpError($statusCode, $rawBody);
        }

        $body = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);

        if (!empty($body['errors'])) {
            throw new GraphQLException(array_column($body['errors'], 'message'));
        }

        return $body['data'] ?? [];
    }

    /**
     * Merge defaultRequestOptions + per-call headers, with per-call taking precedence.
     *
     * @param  RequestOptions|null $requestOptions
     * @return array<string,string>
     */
    private function buildHeaders(string $token, ?RequestOptions $requestOptions): array
    {
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ];

        // Default headers from config (do not overwrite Authorization/Content-Type set above)
        foreach ($this->config->defaultRequestOptions->headers as $key => $value) {
            if (!isset($headers[$key])) {
                $headers[$key] = $value;
            }
        }

        // Per-call headers override everything except the auth/content-type core headers
        if ($requestOptions !== null) {
            foreach ($requestOptions->headers as $key => $value) {
                if (!in_array($key, ['Authorization', 'Content-Type'], true)) {
                    $headers[$key] = $value;
                }
            }
        }

        return $headers;
    }
}
