<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Tests\GraphQL;

use EBay\OffersAndLeads\GraphQL\Types\Inputs\AcceptOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\BuyerNegotiationHistoryInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\CounterOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\DeclineOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\MakeOfferInput;
use EBay\OffersAndLeads\GraphQL\Types\Inputs\SellerNegotiationHistoryInput;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class OfferInputFixtureTest extends TestCase
{
    private static string $fixturesDir = __DIR__ . '/../../fixtures/input';

    public static function fixtures(): iterable
    {
        yield 'acceptOffer'              => ['acceptOffer',              AcceptOfferInput::class];
        yield 'declineOffer'             => ['declineOffer',             DeclineOfferInput::class];
        yield 'sellerNegotiationHistory' => ['sellerNegotiationHistory', SellerNegotiationHistoryInput::class];
        yield 'buyerNegotiationHistory'  => ['buyerNegotiationHistory',  BuyerNegotiationHistoryInput::class];
        yield 'counterOffer'             => ['counterOffer',             CounterOfferInput::class];
        yield 'makeOffer'                => ['makeOffer',                MakeOfferInput::class];
    }

    #[DataProvider('fixtures')]
    public function testFromArrayConstructsSuccessfully(string $operation, string $class): void
    {
        $data     = json_decode(file_get_contents(self::$fixturesDir . '/' . $operation . '.json'), true);
        $instance = $class::fromArray($data['input']);

        $this->assertNotNull($instance);
    }
}
