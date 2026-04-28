<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Clients\Rest;

use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use EBay\OffersAndLeads\Configuration\RequestOptions;
use EBay\OffersAndLeads\Configuration\TokenContext;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Classified_leadRequestBuilderGetQueryParameters;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Classified_leadRequestBuilderGetRequestConfiguration;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Item\WithItemItemRequestBuilderGetQueryParameters;
use EBay\OffersAndLeads\Generated\SellLeads\Classified_lead\Item\WithItemItemRequestBuilderGetRequestConfiguration;
use EBay\OffersAndLeads\Generated\SellLeads\Models\ClassifiedLeadsListResponse;
use EBay\OffersAndLeads\Generated\SellLeads\Models\ClassifiedLead;
use EBay\OffersAndLeads\Generated\SellLeads\SellLeadsApiClient;

final class LeadsClient
{
    public function __construct(
        private readonly SellLeadsApiClient $kiota,
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
        return TokenContext::runWith($accessToken, function () use ($startTime, $endTime, $status, $includeMessages, $requestOptions): ?ClassifiedLeadsListResponse {
            $headers = $this->buildHeaders($requestOptions);

            $requestConfig = new Classified_leadRequestBuilderGetRequestConfiguration(
                headers: $headers ?: null,
                queryParameters: new Classified_leadRequestBuilderGetQueryParameters(
                    endTime: $endTime,
                    includeMessages: $includeMessages,
                    startTime: $startTime,
                    status: $status,
                )
            );

            return $this->kiota->classified_lead()->get($requestConfig)->wait();
        });
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
        return TokenContext::runWith($accessToken, function () use ($itemId, $startTime, $endTime, $status, $includeMessages, $requestOptions): ?ClassifiedLead {
            $headers = $this->buildHeaders($requestOptions);

            $requestConfig = new WithItemItemRequestBuilderGetRequestConfiguration(
                headers: $headers ?: null,
                queryParameters: new WithItemItemRequestBuilderGetQueryParameters(
                    endTime: $endTime,
                    includeMessages: $includeMessages,
                    startTime: $startTime,
                    status: $status,
                )
            );

            return $this->kiota->classified_lead()->byItemId($itemId)->get($requestConfig)->wait();
        });
    }

    /**
     * Build the merged headers array: defaultRequestOptions first, per-call overrides on top.
     * Semantics: per-call values take precedence (last-write wins on duplicate keys).
     *
     * @param  RequestOptions|null $requestOptions
     * @return array<string,string>
     */
    private function buildHeaders(?RequestOptions $requestOptions): array
    {
        $merged = $this->config->defaultRequestOptions->headers;

        if ($requestOptions !== null) {
            foreach ($requestOptions->headers as $key => $value) {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }
}
