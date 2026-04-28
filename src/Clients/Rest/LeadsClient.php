<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Clients\Rest;

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
    public function __construct(private readonly SellLeadsApiClient $kiota) {}

    /**
     * Retrieve all classified ad leads for the seller's active listings.
     *
     * @param  string|null $startTime      ISO 8601 — only leads created on/after this time
     * @param  string|null $endTime        ISO 8601 — only leads created on/before this time
     * @param  string|null $status         'Answered' | 'Unanswered'
     * @param  string|null $includeMessages 'true' | 'false'
     * @param  string|null $accessToken    Per-call token; overrides config fallback
     * @return ClassifiedLeadsListResponse|null
     */
    public function getAllClassifiedLeads(
        ?string $startTime = null,
        ?string $endTime = null,
        ?string $status = null,
        ?string $includeMessages = null,
        ?string $accessToken = null,
    ): ?ClassifiedLeadsListResponse {
        return TokenContext::runWith($accessToken, function () use ($startTime, $endTime, $status, $includeMessages): ?ClassifiedLeadsListResponse {
            $requestConfig = new Classified_leadRequestBuilderGetRequestConfiguration(
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
     * @param  string      $itemId          The unique listing identifier
     * @param  string|null $startTime       ISO 8601 — only leads created on/after this time
     * @param  string|null $endTime         ISO 8601 — only leads created on/before this time
     * @param  string|null $status          'Answered' | 'Unanswered'
     * @param  string|null $includeMessages 'true' | 'false' (default true for this endpoint)
     * @param  string|null $accessToken     Per-call token; overrides config fallback
     * @return ClassifiedLead|null
     */
    public function getClassifiedLeadsByItemId(
        string $itemId,
        ?string $startTime = null,
        ?string $endTime = null,
        ?string $status = null,
        ?string $includeMessages = null,
        ?string $accessToken = null,
    ): ?ClassifiedLead {
        return TokenContext::runWith($accessToken, function () use ($itemId, $startTime, $endTime, $status, $includeMessages): ?ClassifiedLead {
            $requestConfig = new WithItemItemRequestBuilderGetRequestConfiguration(
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
}
