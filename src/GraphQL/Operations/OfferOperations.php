<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Operations;

final class OfferOperations
{
    public const ACCEPT_OFFER = <<<'GRAPHQL'
        mutation AcceptOffer($input: AcceptOfferInput!) {
            acceptOffer(input: $input) {
                __typename
                ... on AcceptOfferSent {
                    offer {
                        offerId
                        status
                        offerCreatorRole
                        createdAt
                        updatedAt
                        expiresAt
                        message
                        quantity
                        offerPrice {
                            original { value currency }
                            converted { value currency }
                        }
                    }
                    purchaseReference {
                        __typename
                    }
                }
                ... on OfferBusinessRulesViolated {
                    errorCode
                    errorMessage
                    violations { ruleDescription }
                }
                ... on ReferenceArgumentsNotFound {
                    errorCode
                    errorMessage
                    argumentNames
                }
            }
        }
        GRAPHQL;

    public const DECLINE_OFFER = <<<'GRAPHQL'
        mutation DeclineOffer($input: DeclineOfferInput!) {
            declineOffer(input: $input) {
                __typename
                ... on DeclineOfferSent {
                    offer {
                        offerId
                        status
                        offerCreatorRole
                        createdAt
                        updatedAt
                        expiresAt
                        message
                        quantity
                        offerPrice {
                            original { value currency }
                            converted { value currency }
                        }
                    }
                }
                ... on OfferBusinessRulesViolated {
                    errorCode
                    errorMessage
                    violations { ruleDescription }
                }
                ... on ReferenceArgumentsNotFound {
                    errorCode
                    errorMessage
                    argumentNames
                }
            }
        }
        GRAPHQL;

    public const SELLER_NEGOTIATION_HISTORY = <<<'GRAPHQL'
        query SellerNegotiationHistory($input: SellerNegotiationHistoryInput!) {
            sellerNegotiationHistory(input: $input) {
                itemNegotiations {
                    item {
                        itemId
                        title
                    }
                    negotiations {
                        negotiationId
                        latestOffer {
                            offerId
                            status
                            offerCreatorRole
                            createdAt
                            updatedAt
                            expiresAt
                            message
                            quantity
                            offerPrice {
                                original { value currency }
                                converted { value currency }
                            }
                        }
                        offers {
                            offerId
                            status
                            offerCreatorRole
                            createdAt
                            updatedAt
                            expiresAt
                            message
                            quantity
                            offerPrice {
                                original { value currency }
                                converted { value currency }
                            }
                        }
                    }
                }
                pagination {
                    nextCursor
                    previousCursor
                }
            }
        }
        GRAPHQL;
}
