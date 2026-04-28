<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads;

use EBay\OffersAndLeads\Clients\GraphQL\DynamicGraphQLClient;
use EBay\OffersAndLeads\Clients\GraphQL\OffersGraphQLClient;
use EBay\OffersAndLeads\Clients\Rest\LeadsClient;
use EBay\OffersAndLeads\Configuration\KiotaAuthProvider;
use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;
use EBay\OffersAndLeads\Generated\SellLeads\SellLeadsApiClient;
use GuzzleHttp\Client as GuzzleClient;
use Microsoft\Kiota\Abstractions\Authentication\BaseBearerTokenAuthenticationProvider;
use Microsoft\Kiota\Http\GuzzleRequestAdapter;

final class OffersAndLeadsClient
{
    /** REST: Classified Leads API */
    public readonly LeadsClient $leads;

    /** GraphQL: acceptOffer, declineOffer, sellerNegotiationHistory */
    public readonly OffersGraphQLClient $offers;

    public function __construct(
        OffersAndLeadsConfiguration $config,
        ?GuzzleClient $guzzle = null,
    ) {
        $guzzle ??= new GuzzleClient([
            'timeout'         => 30,
            'connect_timeout' => 5,
        ]);

        $auth = new BaseBearerTokenAuthenticationProvider(new KiotaAuthProvider($config));

        // REST — Classified Leads
        $leadsAdapter = new GuzzleRequestAdapter($auth, guzzleClient: $guzzle);
        $leadsAdapter->setBaseUrl($config->leadsBaseUrl);
        $this->leads = new LeadsClient(new SellLeadsApiClient($leadsAdapter));

        // GraphQL — Offers & Negotiation History
        $this->offers = new OffersGraphQLClient(
            new DynamicGraphQLClient($guzzle, $config)
        );
    }
}
