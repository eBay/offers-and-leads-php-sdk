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
    /** eBay hosts that receive the access token by default. */
    public const DEFAULT_ALLOWED_HOSTS = [
        'api.ebay.com',
        'api.sandbox.ebay.com',
        'apiz.ebay.com',
        'apiz.sandbox.ebay.com',
        'graphqlapi.sandbox.ebay.com',
    ];

    /** Hosts that may use plain http, for example a local mock server. They must still be allowed hosts. */
    public const LOOPBACK_HOSTS = ['127.0.0.1', '::1', 'localhost'];

    public readonly RequestOptions $defaultRequestOptions;

    /**
     * @param string[] $allowedHosts Additional hosts trusted with the access token, for example
     *     'api.sandbox.ebay.com', or '127.0.0.1' for a local mock server. Every base URL must use a host
     *     from DEFAULT_ALLOWED_HOSTS or this list, and https unless the host is in LOOPBACK_HOSTS.
     * @throws \InvalidArgumentException When a base URL is not trusted.
     */
    public function __construct(
        public readonly string $classifiedLeadsBaseUrl = 'https://apiz.ebay.com/sell/leads/v1',
        public readonly string $negotiationBaseUrl = 'https://api.ebay.com/sell/negotiation/v1',
        public readonly string $graphQLBaseUrl = 'https://api.ebay.com/graphql',
        public readonly ?string $accessToken = null,
        public readonly bool $diagnosticLogging = false,
        public readonly array $allowedHosts = [],
    ) {
        $this->defaultRequestOptions = new RequestOptions();
        foreach ([
            'classifiedLeadsBaseUrl' => $this->classifiedLeadsBaseUrl,
            'negotiationBaseUrl' => $this->negotiationBaseUrl,
            'graphQLBaseUrl' => $this->graphQLBaseUrl,
        ] as $name => $url) {
            $problem = self::untrustedReason($url, $this->getAllowedHosts());
            if ($problem !== null) {
                throw new \InvalidArgumentException(sprintf('%s: %s: %s', $name, $problem, $url));
            }
        }
    }

    public function __debugInfo(): array
    {
        return array_merge(get_object_vars($this), [
            'accessToken' => $this->accessToken !== null ? '***' : null,
        ]);
    }

    /**
     * Hostnames the access token may be sent to, lowercased and without IPv6 brackets.
     *
     * @return string[]
     */
    public function getAllowedHosts(): array
    {
        return array_values(array_unique(array_map(
            [self::class, 'normalizeHost'],
            [...self::DEFAULT_ALLOWED_HOSTS, ...$this->allowedHosts],
        )));
    }

    /** True when $url uses a trusted host and https, or http on a loopback host. */
    public function isTrustedUrl(string $url): bool
    {
        return self::untrustedReason($url, $this->getAllowedHosts()) === null;
    }

    /**
     * Why $url may not receive the access token, or null when it may. The host must be in
     * $allowedHosts, and the scheme https, or http on a host from LOOPBACK_HOSTS. Hosts compare
     * lowercased, without IPv6 brackets.
     *
     * @param string[] $allowedHosts
     */
    public static function untrustedReason(string $url, array $allowedHosts): ?string
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $host = parse_url($url, PHP_URL_HOST);
        if (!is_string($scheme) || !is_string($host)) {
            return 'URL has no scheme or host';
        }
        $scheme = strtolower($scheme);
        $host = self::normalizeHost($host);
        if ($scheme !== 'https' && !($scheme === 'http' && in_array($host, self::LOOPBACK_HOSTS, true))) {
            return 'URL must use https, or http on a loopback host';
        }
        if (!in_array($host, array_map([self::class, 'normalizeHost'], $allowedHosts), true)) {
            return sprintf('Host %s is not trusted; add it to $allowedHosts to send the access token there', $host);
        }
        return null;
    }

    /** Lowercases $host and removes IPv6 brackets. */
    public static function normalizeHost(string $host): string
    {
        $host = strtolower($host);
        return str_starts_with($host, '[') && str_ends_with($host, ']') ? substr($host, 1, -1) : $host;
    }
}
