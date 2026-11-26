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
 * A complex type that defines an offer that a seller makes to eligible buyers.
*/
class Offer implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var bool|null $allowCounterOffer If set to <code>true</code>, the buyer is allowed to make a counter-offer to the seller's offer.
    */
    private ?bool $allowCounterOffer = null;
    
    /**
     * @var User|null $buyer The buyer who has been sent the offer.
    */
    private ?User $buyer = null;
    
    /**
     * @var string|null $creationDate The date and time when the seller's offer was created.  <br><br>The returned timestamp is formatted as an <a href="https://www.iso.org/iso-8601-date-and-time-format.html" title="https://www.iso.org" target="_blank">ISO 8601</a> string, which is based on the 24-hour Coordinated Universal Time (UTC) clock.  <br><br><b>Format:</b> <code>[YYYY]-[MM]-[DD]T[hh]:[mm]:[ss].[sss]Z</code> <br><b>Example:</b> <code>2018-08-20T07:09:00.000Z</code>
    */
    private ?string $creationDate = null;
    
    /**
     * @var string|null $initiatedBy The eBay <b>UserName</b> of the user (seller) who initiated the offer.<br><br><span class="tablenote"><b>Note:</b> Effective September 26, 2025, select developers will no longer receive username data for U.S. users through this field. Instead, an immutable user ID will be returned in its place. For more information, please refer to <a href="/api-docs/static/data-handling-update.html">Data Handling Compliance</a>.</span>
    */
    private ?string $initiatedBy = null;
    
    /**
     * @var string|null $lastModifiedDate The date and time when the offer was last modified.  <br><br>The returned timestamp is formatted as an <a href="http://www.iso.org/iso/home/standards/iso8601.htm" target="_blank">ISO 8601</a> string.
    */
    private ?string $lastModifiedDate = null;
    
    /**
     * @var string|null $message A seller-defined message related to the offer being made. This message is sent to the list of "interested" buyers along with the offer message from eBay.
    */
    private ?string $message = null;
    
    /**
     * @var TimeDuration|null $offerDuration The length of time that the offer is valid.  <br><br>The duration of the offer begins at the date and time denoted by <b>creationDate</b>. When the span of time specified by <b>offerDuration</b> passes beyond the <b>creationDate</b>, the offer expires.
    */
    private ?TimeDuration $offerDuration = null;
    
    /**
     * @var array<OfferedItem>|null $offeredItems The list of items associated with the offer. <br><br>Currently, the offer list is restricted to a single offer.
    */
    private ?array $offeredItems = null;
    
    /**
     * @var string|null $offerId A unique eBay-assigned identifier for the offer.
    */
    private ?string $offerId = null;
    
    /**
     * @var OfferStatusEnum|null $offerStatus The current state, or status, of an offer.  <br><br>Status states include <code>PENDING</code>, <code>COUNTERED</code>, <code>ACCEPTED</code>, and <code>DECLINED</code>.
    */
    private ?OfferStatusEnum $offerStatus = null;
    
    /**
     * @var OfferTypeEnum|null $offerType The type of offer being made.
    */
    private ?OfferTypeEnum $offerType = null;
    
    /**
     * @var string|null $revision A unique, eBay-assigned ID for the revision of the offer.
    */
    private ?string $revision = null;
    
    /**
     * Instantiates a new Offer and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return Offer
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): Offer {
        return new Offer();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * Gets the allowCounterOffer property value. If set to <code>true</code>, the buyer is allowed to make a counter-offer to the seller's offer.
     * @return bool|null
    */
    public function getAllowCounterOffer(): ?bool {
        return $this->allowCounterOffer;
    }

    /**
     * Gets the buyer property value. The buyer who has been sent the offer.
     * @return User|null
    */
    public function getBuyer(): ?User {
        return $this->buyer;
    }

    /**
     * Gets the creationDate property value. The date and time when the seller's offer was created.  <br><br>The returned timestamp is formatted as an <a href="https://www.iso.org/iso-8601-date-and-time-format.html" title="https://www.iso.org" target="_blank">ISO 8601</a> string, which is based on the 24-hour Coordinated Universal Time (UTC) clock.  <br><br><b>Format:</b> <code>[YYYY]-[MM]-[DD]T[hh]:[mm]:[ss].[sss]Z</code> <br><b>Example:</b> <code>2018-08-20T07:09:00.000Z</code>
     * @return string|null
    */
    public function getCreationDate(): ?string {
        return $this->creationDate;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'allowCounterOffer' => fn(ParseNode $n) => $o->setAllowCounterOffer($n->getBooleanValue()),
            'buyer' => fn(ParseNode $n) => $o->setBuyer($n->getObjectValue([User::class, 'createFromDiscriminatorValue'])),
            'creationDate' => fn(ParseNode $n) => $o->setCreationDate($n->getStringValue()),
            'initiatedBy' => fn(ParseNode $n) => $o->setInitiatedBy($n->getStringValue()),
            'lastModifiedDate' => fn(ParseNode $n) => $o->setLastModifiedDate($n->getStringValue()),
            'message' => fn(ParseNode $n) => $o->setMessage($n->getStringValue()),
            'offerDuration' => fn(ParseNode $n) => $o->setOfferDuration($n->getObjectValue([TimeDuration::class, 'createFromDiscriminatorValue'])),
            'offeredItems' => fn(ParseNode $n) => $o->setOfferedItems($n->getCollectionOfObjectValues([OfferedItem::class, 'createFromDiscriminatorValue'])),
            'offerId' => fn(ParseNode $n) => $o->setOfferId($n->getStringValue()),
            'offerStatus' => fn(ParseNode $n) => $o->setOfferStatus($n->getEnumValue(OfferStatusEnum::class)),
            'offerType' => fn(ParseNode $n) => $o->setOfferType($n->getEnumValue(OfferTypeEnum::class)),
            'revision' => fn(ParseNode $n) => $o->setRevision($n->getStringValue()),
        ];
    }

    /**
     * Gets the initiatedBy property value. The eBay <b>UserName</b> of the user (seller) who initiated the offer.<br><br><span class="tablenote"><b>Note:</b> Effective September 26, 2025, select developers will no longer receive username data for U.S. users through this field. Instead, an immutable user ID will be returned in its place. For more information, please refer to <a href="/api-docs/static/data-handling-update.html">Data Handling Compliance</a>.</span>
     * @return string|null
    */
    public function getInitiatedBy(): ?string {
        return $this->initiatedBy;
    }

    /**
     * Gets the lastModifiedDate property value. The date and time when the offer was last modified.  <br><br>The returned timestamp is formatted as an <a href="http://www.iso.org/iso/home/standards/iso8601.htm" target="_blank">ISO 8601</a> string.
     * @return string|null
    */
    public function getLastModifiedDate(): ?string {
        return $this->lastModifiedDate;
    }

    /**
     * Gets the message property value. A seller-defined message related to the offer being made. This message is sent to the list of "interested" buyers along with the offer message from eBay.
     * @return string|null
    */
    public function getMessage(): ?string {
        return $this->message;
    }

    /**
     * Gets the offerDuration property value. The length of time that the offer is valid.  <br><br>The duration of the offer begins at the date and time denoted by <b>creationDate</b>. When the span of time specified by <b>offerDuration</b> passes beyond the <b>creationDate</b>, the offer expires.
     * @return TimeDuration|null
    */
    public function getOfferDuration(): ?TimeDuration {
        return $this->offerDuration;
    }

    /**
     * Gets the offeredItems property value. The list of items associated with the offer. <br><br>Currently, the offer list is restricted to a single offer.
     * @return array<OfferedItem>|null
    */
    public function getOfferedItems(): ?array {
        return $this->offeredItems;
    }

    /**
     * Gets the offerId property value. A unique eBay-assigned identifier for the offer.
     * @return string|null
    */
    public function getOfferId(): ?string {
        return $this->offerId;
    }

    /**
     * Gets the offerStatus property value. The current state, or status, of an offer.  <br><br>Status states include <code>PENDING</code>, <code>COUNTERED</code>, <code>ACCEPTED</code>, and <code>DECLINED</code>.
     * @return OfferStatusEnum|null
    */
    public function getOfferStatus(): ?OfferStatusEnum {
        return $this->offerStatus;
    }

    /**
     * Gets the offerType property value. The type of offer being made.
     * @return OfferTypeEnum|null
    */
    public function getOfferType(): ?OfferTypeEnum {
        return $this->offerType;
    }

    /**
     * Gets the revision property value. A unique, eBay-assigned ID for the revision of the offer.
     * @return string|null
    */
    public function getRevision(): ?string {
        return $this->revision;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeBooleanValue('allowCounterOffer', $this->getAllowCounterOffer());
        $writer->writeObjectValue('buyer', $this->getBuyer());
        $writer->writeStringValue('creationDate', $this->getCreationDate());
        $writer->writeStringValue('initiatedBy', $this->getInitiatedBy());
        $writer->writeStringValue('lastModifiedDate', $this->getLastModifiedDate());
        $writer->writeStringValue('message', $this->getMessage());
        $writer->writeObjectValue('offerDuration', $this->getOfferDuration());
        $writer->writeCollectionOfObjectValues('offeredItems', $this->getOfferedItems());
        $writer->writeStringValue('offerId', $this->getOfferId());
        $writer->writeEnumValue('offerStatus', $this->getOfferStatus());
        $writer->writeEnumValue('offerType', $this->getOfferType());
        $writer->writeStringValue('revision', $this->getRevision());
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
     * Sets the allowCounterOffer property value. If set to <code>true</code>, the buyer is allowed to make a counter-offer to the seller's offer.
     * @param bool|null $value Value to set for the allowCounterOffer property.
    */
    public function setAllowCounterOffer(?bool $value): void {
        $this->allowCounterOffer = $value;
    }

    /**
     * Sets the buyer property value. The buyer who has been sent the offer.
     * @param User|null $value Value to set for the buyer property.
    */
    public function setBuyer(?User $value): void {
        $this->buyer = $value;
    }

    /**
     * Sets the creationDate property value. The date and time when the seller's offer was created.  <br><br>The returned timestamp is formatted as an <a href="https://www.iso.org/iso-8601-date-and-time-format.html" title="https://www.iso.org" target="_blank">ISO 8601</a> string, which is based on the 24-hour Coordinated Universal Time (UTC) clock.  <br><br><b>Format:</b> <code>[YYYY]-[MM]-[DD]T[hh]:[mm]:[ss].[sss]Z</code> <br><b>Example:</b> <code>2018-08-20T07:09:00.000Z</code>
     * @param string|null $value Value to set for the creationDate property.
    */
    public function setCreationDate(?string $value): void {
        $this->creationDate = $value;
    }

    /**
     * Sets the initiatedBy property value. The eBay <b>UserName</b> of the user (seller) who initiated the offer.<br><br><span class="tablenote"><b>Note:</b> Effective September 26, 2025, select developers will no longer receive username data for U.S. users through this field. Instead, an immutable user ID will be returned in its place. For more information, please refer to <a href="/api-docs/static/data-handling-update.html">Data Handling Compliance</a>.</span>
     * @param string|null $value Value to set for the initiatedBy property.
    */
    public function setInitiatedBy(?string $value): void {
        $this->initiatedBy = $value;
    }

    /**
     * Sets the lastModifiedDate property value. The date and time when the offer was last modified.  <br><br>The returned timestamp is formatted as an <a href="http://www.iso.org/iso/home/standards/iso8601.htm" target="_blank">ISO 8601</a> string.
     * @param string|null $value Value to set for the lastModifiedDate property.
    */
    public function setLastModifiedDate(?string $value): void {
        $this->lastModifiedDate = $value;
    }

    /**
     * Sets the message property value. A seller-defined message related to the offer being made. This message is sent to the list of "interested" buyers along with the offer message from eBay.
     * @param string|null $value Value to set for the message property.
    */
    public function setMessage(?string $value): void {
        $this->message = $value;
    }

    /**
     * Sets the offerDuration property value. The length of time that the offer is valid.  <br><br>The duration of the offer begins at the date and time denoted by <b>creationDate</b>. When the span of time specified by <b>offerDuration</b> passes beyond the <b>creationDate</b>, the offer expires.
     * @param TimeDuration|null $value Value to set for the offerDuration property.
    */
    public function setOfferDuration(?TimeDuration $value): void {
        $this->offerDuration = $value;
    }

    /**
     * Sets the offeredItems property value. The list of items associated with the offer. <br><br>Currently, the offer list is restricted to a single offer.
     * @param array<OfferedItem>|null $value Value to set for the offeredItems property.
    */
    public function setOfferedItems(?array $value): void {
        $this->offeredItems = $value;
    }

    /**
     * Sets the offerId property value. A unique eBay-assigned identifier for the offer.
     * @param string|null $value Value to set for the offerId property.
    */
    public function setOfferId(?string $value): void {
        $this->offerId = $value;
    }

    /**
     * Sets the offerStatus property value. The current state, or status, of an offer.  <br><br>Status states include <code>PENDING</code>, <code>COUNTERED</code>, <code>ACCEPTED</code>, and <code>DECLINED</code>.
     * @param OfferStatusEnum|null $value Value to set for the offerStatus property.
    */
    public function setOfferStatus(?OfferStatusEnum $value): void {
        $this->offerStatus = $value;
    }

    /**
     * Sets the offerType property value. The type of offer being made.
     * @param OfferTypeEnum|null $value Value to set for the offerType property.
    */
    public function setOfferType(?OfferTypeEnum $value): void {
        $this->offerType = $value;
    }

    /**
     * Sets the revision property value. A unique, eBay-assigned ID for the revision of the offer.
     * @param string|null $value Value to set for the revision property.
    */
    public function setRevision(?string $value): void {
        $this->revision = $value;
    }

}
