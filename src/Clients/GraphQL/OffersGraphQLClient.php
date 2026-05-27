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

use EBay\OffersAndLeads\Configuration\RequestOptions;
use EBay\OffersAndLeads\GraphQL\Operations\OfferOperations;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\AcceptOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\BuyerNegotiationHistoryInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\CounterOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\DeclineOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\MakeOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\SellerNegotiationHistoryInput;
use EBay\OffersAndLeads\GraphQL\Types\Results\AcceptOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\AcceptOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\BuyerNegotiationHistoryOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\CounterOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\CounterOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\MakeOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\MakeOfferSent;
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
            OfferOperations::ACCEPT_OFFER(),
            ['input' => (object)$input->toArray()],
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
            OfferOperations::DECLINE_OFFER(),
            ['input' => (object)$input->toArray()],
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
            OfferOperations::SELLER_NEGOTIATION_HISTORY(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return SellerNegotiationHistoryOutput::fromArray($data['sellerNegotiationHistory']);
    }

    /**
     * Counter an active offer with a new price.
     *
     * @return CounterOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
     */
    public function counterOffer(
        CounterOfferInput $input,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): CounterOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound {
        $data = $this->dynamic->execute(
            OfferOperations::COUNTER_OFFER(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return CounterOfferOutput::fromArray($data['counterOffer']);
    }

    /**
     * Make an offer on a listing.
     *
     * @return MakeOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
     */
    public function makeOffer(
        MakeOfferInput $input,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): MakeOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound {
        $data = $this->dynamic->execute(
            OfferOperations::MAKE_OFFER(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return MakeOfferOutput::fromArray($data['makeOffer']);
    }

    /**
     * Retrieve the buyer's negotiation history grouped by item.
     */
    public function buyerNegotiationHistory(
        BuyerNegotiationHistoryInput $input,
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): BuyerNegotiationHistoryOutput {
        $data = $this->dynamic->execute(
            OfferOperations::BUYER_NEGOTIATION_HISTORY(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions,
        );
        return BuyerNegotiationHistoryOutput::fromArray($data['buyerNegotiationHistory']);
    }

    /**
     * Execute an arbitrary GraphQL query string and return the raw `data` payload.
     *
     * **WARNING — injection risk.** Never interpolate user-supplied input directly into
     * `$query`. Always pass dynamic values via `$variables` so the server handles
     * escaping. Treat this like a raw SQL string: safe only with static,
     * developer-controlled query text.
     *
     * @param  array<string, mixed> $variables
     * @return array<string, mixed>
     */
    public function executeRawUnsafe(
        string $query,
        array $variables = [],
        ?string $accessToken = null,
        ?RequestOptions $requestOptions = null,
    ): array {
        return $this->dynamic->execute($query, $variables, $accessToken, $requestOptions);
    }
}
