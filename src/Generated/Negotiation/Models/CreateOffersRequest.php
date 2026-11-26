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
 * This complex type contains the fields needed to create an offer to a buyer that is initiated by the seller.
*/
class CreateOffersRequest implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var bool|null $allowCounterOffer If set to <code>true</code>, the buyer is allowed to make a counter-offer to the seller's offer.  <br><br><span class="tablenote"><b>Note:</b> Currently, you must set this field to <code>false</code>; counter-offers are not supported in this release.</span>  <br><br><b>Default:</b> <code>false</code>
    */
    private ?bool $allowCounterOffer = null;
    
    /**
     * @var string|null $message A seller-defined message related to the offer being made.  <br><br>This message is sent to the list of "interested" buyers.  <br><br>To increase the conversion rate of the offers a seller makes to buyers, eBay recommends you always add a customized message to your offers.  <br><br><b>Maximum length:</b> 2,000 characters
    */
    private ?string $message = null;
    
    /**
     * @var TimeDuration|null $offerDuration <div class="msgbox_important"><p class="msgbox_importantInDiv" data-mc-autonum="&lt;b&gt;&lt;span style=&quot;color: #dd1e31;&quot; class=&quot;mcFormatColor&quot;&gt;Important! &lt;/span&gt;&lt;/b&gt;"><span class="autonumber"><span><b><span style="color: #dd1e31;" class="mcFormatColor">Important!</span></b></span></span> The <b>offerDuration</b> value will be set automatically based on the eBay marketplace, and each marketplace has one supported value. Due to this fact, we suggest that this container no longer be used. See <a href="/api-docs/sell/negotiation/overview.html#requirements" target="_blank">Negotiation API requirements and restrictions</a> for the <b>offerDuration</b> value for each marketplace.</p></div><br><br>The length of time, in days, the offer is valid from when it is created.<br><br>The duration of the offer begins at the date and time the offer is sent. When the span of time specified by <b>offerDuration</b> passes beyond the <b>creationDate</b>, the offer expires.
    */
    private ?TimeDuration $offerDuration = null;
    
    /**
     * @var array<OfferedItem>|null $offeredItems An array of objects where each object contains the details of an offer and the ID of the listing on which the offer is being made.  <br><br>Note that the service does not currently support the creation of multiple offers with a single call to <b>sendOfferToInterestedBuyer</b>. With this, each request can target only one listing at a time and you must populate this array with a single element that contains the details of one offer.
    */
    private ?array $offeredItems = null;
    
    /**
     * Instantiates a new CreateOffersRequest and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return CreateOffersRequest
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): CreateOffersRequest {
        return new CreateOffersRequest();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * Gets the allowCounterOffer property value. If set to <code>true</code>, the buyer is allowed to make a counter-offer to the seller's offer.  <br><br><span class="tablenote"><b>Note:</b> Currently, you must set this field to <code>false</code>; counter-offers are not supported in this release.</span>  <br><br><b>Default:</b> <code>false</code>
     * @return bool|null
    */
    public function getAllowCounterOffer(): ?bool {
        return $this->allowCounterOffer;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'allowCounterOffer' => fn(ParseNode $n) => $o->setAllowCounterOffer($n->getBooleanValue()),
            'message' => fn(ParseNode $n) => $o->setMessage($n->getStringValue()),
            'offerDuration' => fn(ParseNode $n) => $o->setOfferDuration($n->getObjectValue([TimeDuration::class, 'createFromDiscriminatorValue'])),
            'offeredItems' => fn(ParseNode $n) => $o->setOfferedItems($n->getCollectionOfObjectValues([OfferedItem::class, 'createFromDiscriminatorValue'])),
        ];
    }

    /**
     * Gets the message property value. A seller-defined message related to the offer being made.  <br><br>This message is sent to the list of "interested" buyers.  <br><br>To increase the conversion rate of the offers a seller makes to buyers, eBay recommends you always add a customized message to your offers.  <br><br><b>Maximum length:</b> 2,000 characters
     * @return string|null
    */
    public function getMessage(): ?string {
        return $this->message;
    }

    /**
     * Gets the offerDuration property value. <div class="msgbox_important"><p class="msgbox_importantInDiv" data-mc-autonum="&lt;b&gt;&lt;span style=&quot;color: #dd1e31;&quot; class=&quot;mcFormatColor&quot;&gt;Important! &lt;/span&gt;&lt;/b&gt;"><span class="autonumber"><span><b><span style="color: #dd1e31;" class="mcFormatColor">Important!</span></b></span></span> The <b>offerDuration</b> value will be set automatically based on the eBay marketplace, and each marketplace has one supported value. Due to this fact, we suggest that this container no longer be used. See <a href="/api-docs/sell/negotiation/overview.html#requirements" target="_blank">Negotiation API requirements and restrictions</a> for the <b>offerDuration</b> value for each marketplace.</p></div><br><br>The length of time, in days, the offer is valid from when it is created.<br><br>The duration of the offer begins at the date and time the offer is sent. When the span of time specified by <b>offerDuration</b> passes beyond the <b>creationDate</b>, the offer expires.
     * @return TimeDuration|null
    */
    public function getOfferDuration(): ?TimeDuration {
        return $this->offerDuration;
    }

    /**
     * Gets the offeredItems property value. An array of objects where each object contains the details of an offer and the ID of the listing on which the offer is being made.  <br><br>Note that the service does not currently support the creation of multiple offers with a single call to <b>sendOfferToInterestedBuyer</b>. With this, each request can target only one listing at a time and you must populate this array with a single element that contains the details of one offer.
     * @return array<OfferedItem>|null
    */
    public function getOfferedItems(): ?array {
        return $this->offeredItems;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeBooleanValue('allowCounterOffer', $this->getAllowCounterOffer());
        $writer->writeStringValue('message', $this->getMessage());
        $writer->writeObjectValue('offerDuration', $this->getOfferDuration());
        $writer->writeCollectionOfObjectValues('offeredItems', $this->getOfferedItems());
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
     * Sets the allowCounterOffer property value. If set to <code>true</code>, the buyer is allowed to make a counter-offer to the seller's offer.  <br><br><span class="tablenote"><b>Note:</b> Currently, you must set this field to <code>false</code>; counter-offers are not supported in this release.</span>  <br><br><b>Default:</b> <code>false</code>
     * @param bool|null $value Value to set for the allowCounterOffer property.
    */
    public function setAllowCounterOffer(?bool $value): void {
        $this->allowCounterOffer = $value;
    }

    /**
     * Sets the message property value. A seller-defined message related to the offer being made.  <br><br>This message is sent to the list of "interested" buyers.  <br><br>To increase the conversion rate of the offers a seller makes to buyers, eBay recommends you always add a customized message to your offers.  <br><br><b>Maximum length:</b> 2,000 characters
     * @param string|null $value Value to set for the message property.
    */
    public function setMessage(?string $value): void {
        $this->message = $value;
    }

    /**
     * Sets the offerDuration property value. <div class="msgbox_important"><p class="msgbox_importantInDiv" data-mc-autonum="&lt;b&gt;&lt;span style=&quot;color: #dd1e31;&quot; class=&quot;mcFormatColor&quot;&gt;Important! &lt;/span&gt;&lt;/b&gt;"><span class="autonumber"><span><b><span style="color: #dd1e31;" class="mcFormatColor">Important!</span></b></span></span> The <b>offerDuration</b> value will be set automatically based on the eBay marketplace, and each marketplace has one supported value. Due to this fact, we suggest that this container no longer be used. See <a href="/api-docs/sell/negotiation/overview.html#requirements" target="_blank">Negotiation API requirements and restrictions</a> for the <b>offerDuration</b> value for each marketplace.</p></div><br><br>The length of time, in days, the offer is valid from when it is created.<br><br>The duration of the offer begins at the date and time the offer is sent. When the span of time specified by <b>offerDuration</b> passes beyond the <b>creationDate</b>, the offer expires.
     * @param TimeDuration|null $value Value to set for the offerDuration property.
    */
    public function setOfferDuration(?TimeDuration $value): void {
        $this->offerDuration = $value;
    }

    /**
     * Sets the offeredItems property value. An array of objects where each object contains the details of an offer and the ID of the listing on which the offer is being made.  <br><br>Note that the service does not currently support the creation of multiple offers with a single call to <b>sendOfferToInterestedBuyer</b>. With this, each request can target only one listing at a time and you must populate this array with a single element that contains the details of one offer.
     * @param array<OfferedItem>|null $value Value to set for the offeredItems property.
    */
    public function setOfferedItems(?array $value): void {
        $this->offeredItems = $value;
    }

}
