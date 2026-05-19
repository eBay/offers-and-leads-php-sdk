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

namespace EBay\OffersAndLeads\Generated\SellLeads\Models;

use Microsoft\Kiota\Abstractions\Serialization\AdditionalDataHolder;
use Microsoft\Kiota\Abstractions\Serialization\Parsable;
use Microsoft\Kiota\Abstractions\Serialization\ParseNode;
use Microsoft\Kiota\Abstractions\Serialization\SerializationWriter;

/**
 * This type defines the field containing any mail message content shared between the seller and prospective buyer.
*/
class MemberMessage implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var array<MemberMessageExchange>|null $memberMessageExchange An array that provides detailed information about a member-to-member message.
    */
    private ?array $memberMessageExchange = null;
    
    /**
     * Instantiates a new MemberMessage and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return MemberMessage
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): MemberMessage {
        return new MemberMessage();
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
            'memberMessageExchange' => fn(ParseNode $n) => $o->setMemberMessageExchange($n->getCollectionOfObjectValues([MemberMessageExchange::class, 'createFromDiscriminatorValue'])),
        ];
    }

    /**
     * Gets the memberMessageExchange property value. An array that provides detailed information about a member-to-member message.
     * @return array<MemberMessageExchange>|null
    */
    public function getMemberMessageExchange(): ?array {
        return $this->memberMessageExchange;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeCollectionOfObjectValues('memberMessageExchange', $this->getMemberMessageExchange());
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
     * Sets the memberMessageExchange property value. An array that provides detailed information about a member-to-member message.
     * @param array<MemberMessageExchange>|null $value Value to set for the memberMessageExchange property.
    */
    public function setMemberMessageExchange(?array $value): void {
        $this->memberMessageExchange = $value;
    }

}
