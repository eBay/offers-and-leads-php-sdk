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
                        offerCreatorRole
                        status
                        offerCreatorUser {
                            shippingZone {
                                postalCode
                            }
                        }
                        offerPrice {
                            original { value currency }
                            converted { value currency }
                        }
                        quantity
                        createdAt
                        updatedAt
                        expiresAt
                        message
                    }
                    purchaseReference {
                        ... on ItemCommitment {
                            __typename
                            itemCommitmentId
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

    public const DECLINE_OFFER = <<<'GRAPHQL'
        mutation DeclineOffer($input: DeclineOfferInput!) {
            declineOffer(input: $input) {
                __typename
                ... on DeclineOfferSent {
                    offer {
                        offerId
                        status
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
                    }
                    negotiations {
                        negotiationId
                        offers {
                            offerId
                            status
                            offerCreatorRole
                            offerPrice {
                                original { value currency }
                                converted { value currency }
                            }
                            quantity
                            createdAt
                            updatedAt
                            expiresAt
                            message
                        }
                        latestOffer {
                            offerId
                            status
                            offerCreatorRole
                            quantity
                            offerPrice {
                                original { value currency }
                                converted { value currency }
                            }
                            createdAt
                            updatedAt
                            expiresAt
                        }
                        offerCapabilities {
                            negotiable
                        }
                        target {
                            ... on Item {
                                itemId
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

    public const BUYER_NEGOTIATION_HISTORY = <<<'GRAPHQL'
        query BuyerNegotiationHistory($input: BuyerNegotiationHistoryInput!) {
            buyerNegotiationHistory(input: $input) {
                itemNegotiations {
                    negotiations {
                        negotiationId
                        offers {
                            offerId
                            status
                            offerCreatorRole
                            offerPrice {
                                original { currency value }
                                converted { currency value }
                            }
                            quantity
                            createdAt
                            updatedAt
                            expiresAt
                            message
                        }
                        latestOffer {
                            offerId
                            status
                            offerCreatorRole
                            quantity
                            offerPrice {
                                original { currency value }
                                converted { currency value }
                            }
                            createdAt
                            updatedAt
                            expiresAt
                        }
                    }
                }
            }
        }
        GRAPHQL;

    public const COUNTER_OFFER = <<<'GRAPHQL'
        mutation CounterOffer($input: CounterOfferInput!) {
            counterOffer(input: $input) {
                __typename
                ... on CounterOfferSent {
                    offer {
                        offerId
                        offerCreatorRole
                        status
                        offerPrice {
                            original { value currency }
                            converted { value currency }
                        }
                        quantity
                        createdAt
                        updatedAt
                        expiresAt
                        message
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

    public const MAKE_OFFER = <<<'GRAPHQL'
        mutation MakeOffer($input: MakeOfferInput!) {
            makeOffer(input: $input) {
                __typename
                ... on MakeOfferSent {
                    offer {
                        offerId
                        offerCreatorRole
                        status
                        offerPrice {
                            original { value currency }
                            converted { value currency }
                        }
                        quantity
                        createdAt
                        updatedAt
                        expiresAt
                        message
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
}
