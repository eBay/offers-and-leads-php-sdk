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
