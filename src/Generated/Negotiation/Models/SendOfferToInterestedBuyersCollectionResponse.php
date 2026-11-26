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

namespace EBay\OffersAndLeads\Generated\Negotiation\Models;

use Microsoft\Kiota\Abstractions\Serialization\AdditionalDataHolder;
use Microsoft\Kiota\Abstractions\Serialization\Parsable;
use Microsoft\Kiota\Abstractions\Serialization\ParseNode;
use Microsoft\Kiota\Abstractions\Serialization\SerializationWriter;

/**
 * The response object returned from a <b>SendOfferToInterestedBuyers</b> request.
*/
class SendOfferToInterestedBuyersCollectionResponse implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var array<Offer>|null $offers The <b>offers</b> container returns a list of the offers sent to buyers who have shown an interest in listings included in the offer.
    */
    private ?array $offers = null;
    
    /**
     * Instantiates a new SendOfferToInterestedBuyersCollectionResponse and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return SendOfferToInterestedBuyersCollectionResponse
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): SendOfferToInterestedBuyersCollectionResponse {
        return new SendOfferToInterestedBuyersCollectionResponse();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'offers' => fn(ParseNode $n) => $o->setOffers($n->getCollectionOfObjectValues([Offer::class, 'createFromDiscriminatorValue'])),
        ];
    }

    /**
     * Gets the offers property value. The <b>offers</b> container returns a list of the offers sent to buyers who have shown an interest in listings included in the offer.
     * @return array<Offer>|null
    */
    public function getOffers(): ?array {
        return $this->offers;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeCollectionOfObjectValues('offers', $this->getOffers());
        $writer->writeAdditionalData($this->getAdditionalData());
    }

    /**
     * Sets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @param array<string,mixed> $value Value to set for the AdditionalData property.
    */
    public function setAdditionalData(?array $value): void {
        $this->additionalData = $value;
    }

    /**
     * Sets the offers property value. The <b>offers</b> container returns a list of the offers sent to buyers who have shown an interest in listings included in the offer.
     * @param array<Offer>|null $value Value to set for the offers property.
    */
    public function setOffers(?array $value): void {
        $this->offers = $value;
    }

}
