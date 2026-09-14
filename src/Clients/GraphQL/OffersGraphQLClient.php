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
use EBay\OffersAndLeads\GraphQL\Types\Results\BuyerNegotiationHistorySuccess;
use EBay\OffersAndLeads\GraphQL\Types\Results\CounterOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\CounterOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\MakeOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\MakeOfferSent;
use EBay\OffersAndLeads\GraphQL\Types\Results\OfferBusinessRulesViolated;
use EBay\OffersAndLeads\GraphQL\Types\Results\ReferenceArgumentsNotFound;
use EBay\OffersAndLeads\GraphQL\Types\Results\SellerNegotiationHistoryOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\SellerNegotiationHistorySuccess;

final class OffersGraphQLClient
{
    public function __construct(private readonly DynamicGraphQLClient $dynamic) {}

    public function acceptOffer(AcceptOfferInput $input, ?string $accessToken = null, ?RequestOptions $requestOptions = null): AcceptOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        $data = $this->dynamic->execute(
            OfferOperations::ACCEPT_OFFER(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions
        );
        return AcceptOfferOutput::fromArray($data['acceptOffer'] ?? []);
    }

    public function buyerNegotiationHistory(BuyerNegotiationHistoryInput $input, ?string $accessToken = null, ?RequestOptions $requestOptions = null): BuyerNegotiationHistorySuccess
    {
        $data = $this->dynamic->execute(
            OfferOperations::BUYER_NEGOTIATION_HISTORY(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions
        );
        return BuyerNegotiationHistoryOutput::fromArray($data['buyerNegotiationHistory'] ?? []);
    }

    public function counterOffer(CounterOfferInput $input, ?string $accessToken = null, ?RequestOptions $requestOptions = null): CounterOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        $data = $this->dynamic->execute(
            OfferOperations::COUNTER_OFFER(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions
        );
        return CounterOfferOutput::fromArray($data['counterOffer'] ?? []);
    }

    public function declineOffer(DeclineOfferInput $input, ?string $accessToken = null, ?RequestOptions $requestOptions = null): DeclineOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        $data = $this->dynamic->execute(
            OfferOperations::DECLINE_OFFER(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions
        );
        return DeclineOfferOutput::fromArray($data['declineOffer'] ?? []);
    }

    public function makeOffer(MakeOfferInput $input, ?string $accessToken = null, ?RequestOptions $requestOptions = null): MakeOfferSent|OfferBusinessRulesViolated|ReferenceArgumentsNotFound
    {
        $data = $this->dynamic->execute(
            OfferOperations::MAKE_OFFER(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions
        );
        return MakeOfferOutput::fromArray($data['makeOffer'] ?? []);
    }

    public function sellerNegotiationHistory(SellerNegotiationHistoryInput $input, ?string $accessToken = null, ?RequestOptions $requestOptions = null): SellerNegotiationHistorySuccess
    {
        $data = $this->dynamic->execute(
            OfferOperations::SELLER_NEGOTIATION_HISTORY(),
            ['input' => (object)$input->toArray()],
            $accessToken,
            $requestOptions
        );
        return SellerNegotiationHistoryOutput::fromArray($data['sellerNegotiationHistory'] ?? []);
    }

    /**
     * Execute an arbitrary GraphQL query string and return the raw `data` payload.
     *
     * **WARNING — injection risk.** Never interpolate user-supplied input directly into
     * `$query`. Always pass dynamic values via `$variables` so the server handles
     * escaping.
     *
     * @param array<string, mixed> $variables
     * @return array<string, mixed>
     */
    public function executeRawUnsafe(string $query, array $variables = [], ?string $accessToken = null, ?RequestOptions $requestOptions = null): array
    {
        return $this->dynamic->execute($query, $variables, $accessToken, $requestOptions);
    }
}
