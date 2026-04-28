<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Clients\GraphQL;

use EBay\OffersAndLeads\Configuration\RequestOptions;
use EBay\OffersAndLeads\GraphQL\Operations\OfferOperations;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\AcceptOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\DeclineOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\SellerNegotiationHistoryInput;
use EBay\OffersAndLeads\GraphQL\Types\Results\AcceptOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\AcceptOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\OfferBusinessRulesViolated;
use EBay\OffersAndLeads\GraphQL\Types\Results\ReferenceArgumentsNotFound;
use EBay\OffersAndLeads\GraphQL\Types\Results\SellerNegotiationHistoryOutput;

final class OffersGraphQLClient
{
    public function __construct(private readonly DynamicGraphQLClient $dynamic) {}

    /**
     * Accept an active offer (or counteroffer).
     *
     * @return AcceptOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
     */
    public function acceptOffer(
        AcceptOfferInput $input,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): AcceptOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound {
        $data = $this->dynamic->execute(
            OfferOperations::ACCEPT_OFFER,
            ['input' => $input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return AcceptOfferOutput::fromArray($data['acceptOffer']);
    }

    /**
     * Decline an active offer (or counteroffer).
     *
     * @return DeclineOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
     */
    public function declineOffer(
        DeclineOfferInput $input,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): DeclineOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound {
        $data = $this->dynamic->execute(
            OfferOperations::DECLINE_OFFER,
            ['input' => $input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return DeclineOfferOutput::fromArray($data['declineOffer']);
    }

    /**
     * Retrieve the seller's negotiation history (latest offer per thread, grouped by item).
     */
    public function sellerNegotiationHistory(
        SellerNegotiationHistoryInput $input,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): SellerNegotiationHistoryOutput {
        $data = $this->dynamic->execute(
            OfferOperations::SELLER_NEGOTIATION_HISTORY,
            ['input' => $input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return SellerNegotiationHistoryOutput::fromArray($data['sellerNegotiationHistory']);
    }

    /**
     * Escape hatch — send any GraphQL query/mutation and get the raw data array back.
     *
     * @param  array<string, mixed> $variables
     * @return array<string, mixed>
     */
    public function executeRaw(
        string $query,
        array $variables = [],
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): array {
        return $this->dynamic->execute($query, $variables, $accessToken, $requestOptions);
    }
}
