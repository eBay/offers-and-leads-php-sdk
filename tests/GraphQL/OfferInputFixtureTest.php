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
    private static string $fixturesDir = __DIR__ . '/../../fixtures/input/Offer';

    public static function fixtures(): iterable
    {
        yield 'AcceptOffer'              => ['AcceptOffer',              AcceptOfferInput::class];
        yield 'DeclineOffer'             => ['DeclineOffer',             DeclineOfferInput::class];
        yield 'SellerNegotiationHistory' => ['SellerNegotiationHistory', SellerNegotiationHistoryInput::class];
        yield 'BuyerNegotiationHistory'  => ['BuyerNegotiationHistory',  BuyerNegotiationHistoryInput::class];
        yield 'CounterOffer'             => ['CounterOffer',             CounterOfferInput::class];
        yield 'MakeOffer'                => ['MakeOffer',                MakeOfferInput::class];
    }

    #[DataProvider('fixtures')]
    public function testFixtureParsing(string $operation, string $class): void
    {
        $data = json_decode(file_get_contents(self::$fixturesDir . '/' . $operation . '.json'), true);

        $result = $class::fromArray($data['input']);

        $this->assertNotNull($result);
    }
}
