# eBay Offers & Leads PHP SDK

PHP SDK for eBay Offers & Leads APIs, combining REST (Kiota) and GraphQL clients.

## Covered APIs

| API | Client Property | Description |
|-----|----------------|-------------|
| **Classified Leads API** (REST) | `$sdk->leads` | Retrieve and respond to purchase leads from classified ad listings |
| **Offers & Negotiation** (GraphQL) | `$sdk->offers` | Accept, decline, counter, and make offers; view negotiation history |

## Requirements

- PHP 8.2+
- Composer
- An eBay developer account with valid OAuth credentials

## Installation

```bash
composer require ebay/offers-and-leads
```

Or add as a path repository for local development:

```json
{
  "repositories": [
    { "type": "path", "url": "../offers-and-leads-php-sdk" }
  ],
  "require": {
    "ebay/offers-and-leads": "*"
  }
}
```

## Quick Start

```php
use EBay\OffersAndLeads\OffersAndLeadsClient;
use EBay\OffersAndLeads\Configuration\OffersAndLeadsConfiguration;

$config = new OffersAndLeadsConfiguration();
$config->accessToken = 'your-ebay-access-token';

$sdk = new OffersAndLeadsClient($config);
```

## Usage Examples

### Classified Leads (REST)

```php
$leads = $sdk->leads->getAllClassifiedLeads(
    status: 'Unanswered',
    includeMessages: 'true',
);

$lead = $sdk->leads->getClassifiedLeadsByItemId(
    itemId: '123456789012',
    includeMessages: 'true',
);
```

### Accept an Offer (GraphQL)

```php
use EBay\OffersAndLeads\GraphQL\Types\Inputs\AcceptOfferInput;

$result = $sdk->offers->acceptOffer(new AcceptOfferInput(
    itemId: 'v1|123456789012|0',
    offerId: '5000000001',
    message: 'Offer accepted!',
));
```

### Decline an Offer (GraphQL)

```php
use EBay\OffersAndLeads\GraphQL\Types\Inputs\DeclineOfferInput;

$result = $sdk->offers->declineOffer(new DeclineOfferInput(
    itemId: 'v1|123456789012|0',
    offerId: '5000000001',
));
```

### Counter an Offer (GraphQL)

```php
use EBay\OffersAndLeads\GraphQL\Types\Inputs\CounterOfferInput;

$result = $sdk->offers->counterOffer(new CounterOfferInput(
    itemId: 'v1|123456789012|0',
    offerId: '5000000001',
    proposedPrice: ['value' => '75.00', 'currency' => 'USD'],
    quantity: 1,
    message: 'How about this price?',
));
```

### Make an Offer (GraphQL)

```php
use EBay\OffersAndLeads\GraphQL\Types\Inputs\MakeOfferInput;

$result = $sdk->offers->makeOffer(new MakeOfferInput(
    itemId: 'v1|123456789012|0',
    proposedPrice: ['value' => '50.00', 'currency' => 'USD'],
    quantity: 1,
    message: 'Would you accept this offer?',
));
```

### Seller Negotiation History (GraphQL)

```php
use EBay\OffersAndLeads\GraphQL\Types\Inputs\SellerNegotiationHistoryInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\NegotiationHistoryFiltersInput;

$result = $sdk->offers->sellerNegotiationHistory(new SellerNegotiationHistoryInput(
    filters: new NegotiationHistoryFiltersInput(
        activeAfter: '2025-01-01T00:00:00Z',
    ),
));
```

### Buyer Negotiation History (GraphQL)

```php
use EBay\OffersAndLeads\GraphQL\Types\Inputs\BuyerNegotiationHistoryInput;

$result = $sdk->offers->buyerNegotiationHistory(new BuyerNegotiationHistoryInput());
```

### Raw GraphQL (Escape Hatch)

```php
// WARNING: never interpolate user input into the query string — use $variables instead.
$data = $sdk->offers->executeRawUnsafe('query { sellerNegotiationHistory { ... } }');
```

## Per-Call Token Override

```php
$leads = $sdk->leads->getAllClassifiedLeads(accessToken: 'different-token');
```

## Custom Headers

```php
use EBay\OffersAndLeads\Configuration\RequestOptions;

$opts = new RequestOptions(headers: ['X-EBAY-C-MARKETPLACE-ID' => 'EBAY_US']);
$leads = $sdk->leads->getAllClassifiedLeads(requestOptions: $opts);
```

## Diagnostic Logging

```php
$config->diagnosticLogging = true;
```

## OAuth Scopes

| API | Required Scopes |
|-----|----------------|
| Classified Leads | `https://api.ebay.com/oauth/api_scope/sell.leads` |
| Offers (GraphQL) | `https://api.ebay.com/oauth/api_scope` |

## Specs

- OpenAPI: `specs/openapi/classified-leads.yaml` (Classified Leads API)
- GraphQL: `specs/eBay_Graph.graphqls`

To regenerate Kiota clients:

```bash
./generate.sh
composer dump-autoload
```

## Architecture

```
src/
  OffersAndLeadsClient.php                  <- Facade: ->leads (REST), ->offers (GraphQL)
  Configuration/
    OffersAndLeadsConfiguration.php         <- Base URLs, fallback accessToken, options
    KiotaAuthProvider.php                   <- AccessTokenProvider bridge for Kiota
    TokenContext.php                        <- Static per-call token carrier
    RequestOptions.php                      <- Per-call custom headers
  Clients/
    Rest/LeadsClient.php                    <- Wrapper over Kiota Classified Leads client
    GraphQL/
      OffersGraphQLClient.php               <- Typed wrapper for offer mutations/queries
      DynamicGraphQLClient.php              <- Raw Guzzle POST to GraphQL endpoint
  GraphQL/
    Operations/OfferOperations.php          <- GraphQL query/mutation strings
    Types/Inputs/                           <- Typed input classes
    Types/Results/                          <- Typed result classes
  Generated/SellLeads/                      <- Kiota output (committed to source control)
specs/
  sell_feed_v1_oas3.yaml                    <- OpenAPI spec (Classified Leads)
  eBay_Graph.graphqls                       <- eBay Graph schema
```

## License

This project is licensed under the Apache License 2.0. See [LICENSE](LICENSE) for details.
