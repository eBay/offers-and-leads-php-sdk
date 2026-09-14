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
 * This type defines the fields containing detailed information about a member-to-member message.
*/
class MemberMessageExchange implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var string|null $creationDate Date the message was created. Returned if the parent container is returned.
    */
    private ?string $creationDate = null;
    
    /**
     * @var Question|null $question Question
    */
    private ?Question $question = null;
    
    /**
     * @var string|null $response An answer to the question. Contains the body of the seller's response message, if sent.
    */
    private ?string $response = null;
    
    /**
     * Instantiates a new MemberMessageExchange and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return MemberMessageExchange
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): MemberMessageExchange {
        return new MemberMessageExchange();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * Gets the creationDate property value. Date the message was created. Returned if the parent container is returned.
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
            'creationDate' => fn(ParseNode $n) => $o->setCreationDate($n->getStringValue()),
            'question' => fn(ParseNode $n) => $o->setQuestion($n->getObjectValue([Question::class, 'createFromDiscriminatorValue'])),
            'response' => fn(ParseNode $n) => $o->setResponse($n->getStringValue()),
        ];
    }

    /**
     * Gets the question property value. Question
     * @return Question|null
    */
    public function getQuestion(): ?Question {
        return $this->question;
    }

    /**
     * Gets the response property value. An answer to the question. Contains the body of the seller's response message, if sent.
     * @return string|null
    */
    public function getResponse(): ?string {
        return $this->response;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeStringValue('creationDate', $this->getCreationDate());
        $writer->writeObjectValue('question', $this->getQuestion());
        $writer->writeStringValue('response', $this->getResponse());
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
     * Sets the creationDate property value. Date the message was created. Returned if the parent container is returned.
     * @param string|null $value Value to set for the creationDate property.
    */
    public function setCreationDate(?string $value): void {
        $this->creationDate = $value;
    }

    /**
     * Sets the question property value. Question
     * @param Question|null $value Value to set for the question property.
    */
    public function setQuestion(?Question $value): void {
        $this->question = $value;
    }

    /**
     * Sets the response property value. An answer to the question. Contains the body of the seller's response message, if sent.
     * @param string|null $value Value to set for the response property.
    */
    public function setResponse(?string $value): void {
        $this->response = $value;
    }

}
