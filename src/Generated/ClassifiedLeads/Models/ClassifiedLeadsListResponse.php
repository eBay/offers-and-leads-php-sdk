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
 * This type contains an array of the seller's active classified ad listings and the total number of items and leads.
*/
class ClassifiedLeadsListResponse implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var array<ClassifiedLead>|null $classifiedLeads An array of leads for the seller's active classified ad listings.
    */
    private ?array $classifiedLeads = null;
    
    /**
     * @var int|null $totalItems The total number of listings returned.
    */
    private ?int $totalItems = null;
    
    /**
     * @var int|null $totalLeads The total number of leads returned for all listings.
    */
    private ?int $totalLeads = null;
    
    /**
     * Instantiates a new ClassifiedLeadsListResponse and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return ClassifiedLeadsListResponse
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): ClassifiedLeadsListResponse {
        return new ClassifiedLeadsListResponse();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * Gets the classifiedLeads property value. An array of leads for the seller's active classified ad listings.
     * @return array<ClassifiedLead>|null
    */
    public function getClassifiedLeads(): ?array {
        return $this->classifiedLeads;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'classifiedLeads' => fn(ParseNode $n) => $o->setClassifiedLeads($n->getCollectionOfObjectValues([ClassifiedLead::class, 'createFromDiscriminatorValue'])),
            'totalItems' => fn(ParseNode $n) => $o->setTotalItems($n->getIntegerValue()),
            'totalLeads' => fn(ParseNode $n) => $o->setTotalLeads($n->getIntegerValue()),
        ];
    }

    /**
     * Gets the totalItems property value. The total number of listings returned.
     * @return int|null
    */
    public function getTotalItems(): ?int {
        return $this->totalItems;
    }

    /**
     * Gets the totalLeads property value. The total number of leads returned for all listings.
     * @return int|null
    */
    public function getTotalLeads(): ?int {
        return $this->totalLeads;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeCollectionOfObjectValues('classifiedLeads', $this->getClassifiedLeads());
        $writer->writeIntegerValue('totalItems', $this->getTotalItems());
        $writer->writeIntegerValue('totalLeads', $this->getTotalLeads());
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
     * Sets the classifiedLeads property value. An array of leads for the seller's active classified ad listings.
     * @param array<ClassifiedLead>|null $value Value to set for the classifiedLeads property.
    */
    public function setClassifiedLeads(?array $value): void {
        $this->classifiedLeads = $value;
    }

    /**
     * Sets the totalItems property value. The total number of listings returned.
     * @param int|null $value Value to set for the totalItems property.
    */
    public function setTotalItems(?int $value): void {
        $this->totalItems = $value;
    }

    /**
     * Sets the totalLeads property value. The total number of leads returned for all listings.
     * @param int|null $value Value to set for the totalLeads property.
    */
    public function setTotalLeads(?int $value): void {
        $this->totalLeads = $value;
    }

}
