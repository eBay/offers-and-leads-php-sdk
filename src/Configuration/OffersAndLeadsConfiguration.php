<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Configuration;

final class OffersAndLeadsConfiguration
{
    /** Base URL for the Classified Leads REST API. */
    public string $leadsBaseUrl = 'https://apiz.ebay.com';

    /** Base URL for the eBay GraphQL API. */
    public string $graphQLBaseUrl = 'https://api.ebay.com/graphql';

    /** Static fallback access token; per-call token takes precedence. */
    public ?string $accessToken = null;

    public bool $diagnosticLogging = false;

    /** Hostnames tokens may be sent to — passed to AllowedHostsValidator. */
    public function getAllowedHosts(): array
    {
        return array_unique(array_filter(array_map(
            fn(string $url) => parse_url($url, PHP_URL_HOST),
            [$this->leadsBaseUrl, $this->graphQLBaseUrl]
        )));
    }
}
