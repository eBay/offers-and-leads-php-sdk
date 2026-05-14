<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\GraphQL\Operations;

final class OfferOperations
{
    public static function ACCEPT_OFFER(): string
    {
        return file_get_contents(__DIR__ . '/acceptOffer.graphql');
    }

    public static function DECLINE_OFFER(): string
    {
        return file_get_contents(__DIR__ . '/declineOffer.graphql');
    }

    public static function SELLER_NEGOTIATION_HISTORY(): string
    {
        return file_get_contents(__DIR__ . '/sellerNegotiationHistory.graphql');
    }

    public static function BUYER_NEGOTIATION_HISTORY(): string
    {
        return file_get_contents(__DIR__ . '/buyerNegotiationHistory.graphql');
    }

    public static function COUNTER_OFFER(): string
    {
        return file_get_contents(__DIR__ . '/counterOffer.graphql');
    }

    public static function MAKE_OFFER(): string
    {
        return file_get_contents(__DIR__ . '/makeOffer.graphql');
    }
}
