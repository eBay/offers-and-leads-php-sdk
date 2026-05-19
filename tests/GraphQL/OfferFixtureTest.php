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
    private static string $fixturesDir = __DIR__ . '/../../fixtures/output';

    public static function fixtures(): iterable
    {
        $operationMap = [
            'acceptOffer'               => ['acceptOffer',               AcceptOfferOutput::class],
            'declineOffer'              => ['declineOffer',              DeclineOfferOutput::class],
            'sellerNegotiationHistory'  => ['sellerNegotiationHistory',  SellerNegotiationHistoryOutput::class],
            'buyerNegotiationHistory'   => ['buyerNegotiationHistory',   BuyerNegotiationHistoryOutput::class],
            'counterOffer'              => ['counterOffer',              CounterOfferOutput::class],
            'makeOffer'                 => ['makeOffer',                 MakeOfferOutput::class],
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
