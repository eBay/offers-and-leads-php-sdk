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

namespace EBay\OffersAndLeads\Generated\ClassifiedLeads\Models;

use Microsoft\Kiota\Abstractions\Serialization\AdditionalDataHolder;
use Microsoft\Kiota\Abstractions\Serialization\Parsable;
use Microsoft\Kiota\Abstractions\Serialization\ParseNode;
use Microsoft\Kiota\Abstractions\Serialization\SerializationWriter;

/**
 * This type provides classified lead responses including any contact information that prospective buyers have submitted.
*/
class ClassifiedLeadResponses implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var string|null $additionalInformation This field shows the first message that was sent from the prospective buyer to the seller. This will be the same content as in the <b>memberMessageExchange.question.body</b> field, if returned. <br><br><span class="tablenote"> <strong>Note:</strong> Retrieve the <b>memberMessageExchange</b> container to retrieve the entire exchange between the seller and the prospective buyer (all messages).</span>
    */
    private ?string $additionalInformation = null;
    
    /**
     * @var ContactInformation|null $contactInformation This type consists of contact information for the prospective buyer.
    */
    private ?ContactInformation $contactInformation = null;
    
    /**
     * @var string|null $email Email address for the prospective buyer, if that buyer was logged in to eBay.
    */
    private ?string $email = null;
    
    /**
     * @var string|null $externalEmail Email address for the prospective buyer as entered in the lead form on the <b>View Item</b> page. Provides a way for sellers to contact prospective buyers who choose not to log in to eBay. This applies to only eBay Motors and eBay Motors categories.
    */
    private ?string $externalEmail = null;
    
    /**
     * @var bool|null $financingAnswer Boolean that indicates if a prospective buyer answered whether or not they would like financing. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
    */
    private ?bool $financingAnswer = null;
    
    /**
     * @var LeadFee|null $leadFee This type returns the amount charged for the lead service.
    */
    private ?LeadFee $leadFee = null;
    
    /**
     * @var string|null $leadStatus The enumeration value in this field indicates whether or not the seller has responded to the lead, or if this is new. For implementation help, refer to <a href='https://developer.ebay.com/api-docs/sell/leads/types/api:LeadStatus'>eBay API documentation</a>
    */
    private ?string $leadStatus = null;
    
    /**
     * @var MemberMessage|null $memberMessage This type defines the field containing any mail message content shared between the seller and prospective buyer.
    */
    private ?MemberMessage $memberMessage = null;
    
    /**
     * @var string|null $submittedTime Date and time (in GMT) that the lead was submitted.
    */
    private ?string $submittedTime = null;
    
    /**
     * @var string|null $tradeInMake The make of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
    */
    private ?string $tradeInMake = null;
    
    /**
     * @var string|null $tradeInModel The model of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
    */
    private ?string $tradeInModel = null;
    
    /**
     * @var string|null $tradeInYear The year of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
    */
    private ?string $tradeInYear = null;
    
    /**
     * @var string|null $userId The eBay user ID of the user who is interested in the seller's item.
    */
    private ?string $userId = null;
    
    /**
     * Instantiates a new ClassifiedLeadResponses and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return ClassifiedLeadResponses
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): ClassifiedLeadResponses {
        return new ClassifiedLeadResponses();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * Gets the additionalInformation property value. This field shows the first message that was sent from the prospective buyer to the seller. This will be the same content as in the <b>memberMessageExchange.question.body</b> field, if returned. <br><br><span class="tablenote"> <strong>Note:</strong> Retrieve the <b>memberMessageExchange</b> container to retrieve the entire exchange between the seller and the prospective buyer (all messages).</span>
     * @return string|null
    */
    public function getAdditionalInformation(): ?string {
        return $this->additionalInformation;
    }

    /**
     * Gets the contactInformation property value. This type consists of contact information for the prospective buyer.
     * @return ContactInformation|null
    */
    public function getContactInformation(): ?ContactInformation {
        return $this->contactInformation;
    }

    /**
     * Gets the email property value. Email address for the prospective buyer, if that buyer was logged in to eBay.
     * @return string|null
    */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * Gets the externalEmail property value. Email address for the prospective buyer as entered in the lead form on the <b>View Item</b> page. Provides a way for sellers to contact prospective buyers who choose not to log in to eBay. This applies to only eBay Motors and eBay Motors categories.
     * @return string|null
    */
    public function getExternalEmail(): ?string {
        return $this->externalEmail;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'additionalInformation' => fn(ParseNode $n) => $o->setAdditionalInformation($n->getStringValue()),
            'contactInformation' => fn(ParseNode $n) => $o->setContactInformation($n->getObjectValue([ContactInformation::class, 'createFromDiscriminatorValue'])),
            'email' => fn(ParseNode $n) => $o->setEmail($n->getStringValue()),
            'externalEmail' => fn(ParseNode $n) => $o->setExternalEmail($n->getStringValue()),
            'financingAnswer' => fn(ParseNode $n) => $o->setFinancingAnswer($n->getBooleanValue()),
            'leadFee' => fn(ParseNode $n) => $o->setLeadFee($n->getObjectValue([LeadFee::class, 'createFromDiscriminatorValue'])),
            'leadStatus' => fn(ParseNode $n) => $o->setLeadStatus($n->getStringValue()),
            'memberMessage' => fn(ParseNode $n) => $o->setMemberMessage($n->getObjectValue([MemberMessage::class, 'createFromDiscriminatorValue'])),
            'submittedTime' => fn(ParseNode $n) => $o->setSubmittedTime($n->getStringValue()),
            'tradeInMake' => fn(ParseNode $n) => $o->setTradeInMake($n->getStringValue()),
            'tradeInModel' => fn(ParseNode $n) => $o->setTradeInModel($n->getStringValue()),
            'tradeInYear' => fn(ParseNode $n) => $o->setTradeInYear($n->getStringValue()),
            'userId' => fn(ParseNode $n) => $o->setUserId($n->getStringValue()),
        ];
    }

    /**
     * Gets the financingAnswer property value. Boolean that indicates if a prospective buyer answered whether or not they would like financing. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @return bool|null
    */
    public function getFinancingAnswer(): ?bool {
        return $this->financingAnswer;
    }

    /**
     * Gets the leadFee property value. This type returns the amount charged for the lead service.
     * @return LeadFee|null
    */
    public function getLeadFee(): ?LeadFee {
        return $this->leadFee;
    }

    /**
     * Gets the leadStatus property value. The enumeration value in this field indicates whether or not the seller has responded to the lead, or if this is new. For implementation help, refer to <a href='https://developer.ebay.com/api-docs/sell/leads/types/api:LeadStatus'>eBay API documentation</a>
     * @return string|null
    */
    public function getLeadStatus(): ?string {
        return $this->leadStatus;
    }

    /**
     * Gets the memberMessage property value. This type defines the field containing any mail message content shared between the seller and prospective buyer.
     * @return MemberMessage|null
    */
    public function getMemberMessage(): ?MemberMessage {
        return $this->memberMessage;
    }

    /**
     * Gets the submittedTime property value. Date and time (in GMT) that the lead was submitted.
     * @return string|null
    */
    public function getSubmittedTime(): ?string {
        return $this->submittedTime;
    }

    /**
     * Gets the tradeInMake property value. The make of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @return string|null
    */
    public function getTradeInMake(): ?string {
        return $this->tradeInMake;
    }

    /**
     * Gets the tradeInModel property value. The model of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @return string|null
    */
    public function getTradeInModel(): ?string {
        return $this->tradeInModel;
    }

    /**
     * Gets the tradeInYear property value. The year of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @return string|null
    */
    public function getTradeInYear(): ?string {
        return $this->tradeInYear;
    }

    /**
     * Gets the userId property value. The eBay user ID of the user who is interested in the seller's item.
     * @return string|null
    */
    public function getUserId(): ?string {
        return $this->userId;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeStringValue('additionalInformation', $this->getAdditionalInformation());
        $writer->writeObjectValue('contactInformation', $this->getContactInformation());
        $writer->writeStringValue('email', $this->getEmail());
        $writer->writeStringValue('externalEmail', $this->getExternalEmail());
        $writer->writeBooleanValue('financingAnswer', $this->getFinancingAnswer());
        $writer->writeObjectValue('leadFee', $this->getLeadFee());
        $writer->writeStringValue('leadStatus', $this->getLeadStatus());
        $writer->writeObjectValue('memberMessage', $this->getMemberMessage());
        $writer->writeStringValue('submittedTime', $this->getSubmittedTime());
        $writer->writeStringValue('tradeInMake', $this->getTradeInMake());
        $writer->writeStringValue('tradeInModel', $this->getTradeInModel());
        $writer->writeStringValue('tradeInYear', $this->getTradeInYear());
        $writer->writeStringValue('userId', $this->getUserId());
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
     * Sets the additionalInformation property value. This field shows the first message that was sent from the prospective buyer to the seller. This will be the same content as in the <b>memberMessageExchange.question.body</b> field, if returned. <br><br><span class="tablenote"> <strong>Note:</strong> Retrieve the <b>memberMessageExchange</b> container to retrieve the entire exchange between the seller and the prospective buyer (all messages).</span>
     * @param string|null $value Value to set for the additionalInformation property.
    */
    public function setAdditionalInformation(?string $value): void {
        $this->additionalInformation = $value;
    }

    /**
     * Sets the contactInformation property value. This type consists of contact information for the prospective buyer.
     * @param ContactInformation|null $value Value to set for the contactInformation property.
    */
    public function setContactInformation(?ContactInformation $value): void {
        $this->contactInformation = $value;
    }

    /**
     * Sets the email property value. Email address for the prospective buyer, if that buyer was logged in to eBay.
     * @param string|null $value Value to set for the email property.
    */
    public function setEmail(?string $value): void {
        $this->email = $value;
    }

    /**
     * Sets the externalEmail property value. Email address for the prospective buyer as entered in the lead form on the <b>View Item</b> page. Provides a way for sellers to contact prospective buyers who choose not to log in to eBay. This applies to only eBay Motors and eBay Motors categories.
     * @param string|null $value Value to set for the externalEmail property.
    */
    public function setExternalEmail(?string $value): void {
        $this->externalEmail = $value;
    }

    /**
     * Sets the financingAnswer property value. Boolean that indicates if a prospective buyer answered whether or not they would like financing. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @param bool|null $value Value to set for the financingAnswer property.
    */
    public function setFinancingAnswer(?bool $value): void {
        $this->financingAnswer = $value;
    }

    /**
     * Sets the leadFee property value. This type returns the amount charged for the lead service.
     * @param LeadFee|null $value Value to set for the leadFee property.
    */
    public function setLeadFee(?LeadFee $value): void {
        $this->leadFee = $value;
    }

    /**
     * Sets the leadStatus property value. The enumeration value in this field indicates whether or not the seller has responded to the lead, or if this is new. For implementation help, refer to <a href='https://developer.ebay.com/api-docs/sell/leads/types/api:LeadStatus'>eBay API documentation</a>
     * @param string|null $value Value to set for the leadStatus property.
    */
    public function setLeadStatus(?string $value): void {
        $this->leadStatus = $value;
    }

    /**
     * Sets the memberMessage property value. This type defines the field containing any mail message content shared between the seller and prospective buyer.
     * @param MemberMessage|null $value Value to set for the memberMessage property.
    */
    public function setMemberMessage(?MemberMessage $value): void {
        $this->memberMessage = $value;
    }

    /**
     * Sets the submittedTime property value. Date and time (in GMT) that the lead was submitted.
     * @param string|null $value Value to set for the submittedTime property.
    */
    public function setSubmittedTime(?string $value): void {
        $this->submittedTime = $value;
    }

    /**
     * Sets the tradeInMake property value. The make of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @param string|null $value Value to set for the tradeInMake property.
    */
    public function setTradeInMake(?string $value): void {
        $this->tradeInMake = $value;
    }

    /**
     * Sets the tradeInModel property value. The model of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @param string|null $value Value to set for the tradeInModel property.
    */
    public function setTradeInModel(?string $value): void {
        $this->tradeInModel = $value;
    }

    /**
     * Sets the tradeInYear property value. The year of the vehicle the prospective buyer would like to trade in. Entered on the lead form on the <b>View Item</b> page. Applies to eBay Motors and Motors categories only.
     * @param string|null $value Value to set for the tradeInYear property.
    */
    public function setTradeInYear(?string $value): void {
        $this->tradeInYear = $value;
    }

    /**
     * Sets the userId property value. The eBay user ID of the user who is interested in the seller's item.
     * @param string|null $value Value to set for the userId property.
    */
    public function setUserId(?string $value): void {
        $this->userId = $value;
    }

}
