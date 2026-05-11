<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Tests\GraphQL;

use EBay\OffersAndLeads\GraphQL\Types\Results\AcceptOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\BuyerNegotiationHistoryOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\CounterOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\DeclineOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\MakeOfferOutput;
use EBay\OffersAndLeads\GraphQL\Types\Results\SellerNegotiationHistoryOutput;
use PHPUnit\Framework\TestCase;

class OfferFixtureTest extends TestCase
{
    private static string $fixturesDir = __DIR__ . '/../../fixtures/output/Offer';

    public static function fixtures(): iterable
    {
        $operationMap = [
            'AcceptOffer'               => ['acceptOffer',               AcceptOfferOutput::class],
            'DeclineOffer'              => ['declineOffer',              DeclineOfferOutput::class],
            'SellerNegotiationHistory'  => ['sellerNegotiationHistory',  SellerNegotiationHistoryOutput::class],
            'BuyerNegotiationHistory'   => ['buyerNegotiationHistory',   BuyerNegotiationHistoryOutput::class],
            'CounterOffer'              => ['counterOffer',              CounterOfferOutput::class],
            'MakeOffer'                 => ['makeOffer',                 MakeOfferOutput::class],
        ];

        $dir = self::$fixturesDir;

        foreach ($operationMap as $operation => [$key, $class]) {
            $subdir = $dir . '/' . $operation;
            $flat   = $dir . '/' . $operation . '.json';

            if (is_dir($subdir)) {
                foreach (glob($subdir . '/*.json') as $file) {
                    $variant = basename($file, '.json');
                    yield $operation . '/' . $variant => [$file, $key, $class];
                }
            } elseif (file_exists($flat)) {
                yield $operation => [$flat, $key, $class];
            }
        }
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('fixtures')]
    public function testFixtureParsing(string $file, string $key, string $class): void
    {
        $data = json_decode(file_get_contents($file), true);

        $result = $class::fromArray($data[$key]);

        $this->assertNotNull($result);
    }
}
