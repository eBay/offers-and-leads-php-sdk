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
 * This type provides monetary amount of the special fee.
*/
class Amount implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var string|null $convertedFromCurrency A three-letter ISO 4217 code that indicates the currency of the amount in the <b>convertedFromValue</b> field. This value is required or returned only if currency conversion/localization is required, and represents the pre-conversion currency.
    */
    private ?string $convertedFromCurrency = null;
    
    /**
     * @var string|null $convertedFromValue The monetary amount before any conversion is performed, in the currency specified by the <b>convertedFromCurrency</b> field. This value is required or returned only if currency conversion/localization is required. The value field contains the converted amount of this value, in the currency specified by the <b>currency</b> field.
    */
    private ?string $convertedFromValue = null;
    
    /**
     * @var string|null $currency A three-letter ISO 4217 code that indicates the currency of the amount in the <b>value</b> field. If currency conversion/localization is required, this is the post-conversion currency of the amount in the <b>value</b> field.
    */
    private ?string $currency = null;
    
    /**
     * @var string|null $value The monetary amount, in the currency specified by the <b>currency</b> field. If currency conversion/localization is required, this value is the converted amount, and the <b>convertedFromValue</b> field contains the amount in the original currency.
    */
    private ?string $value = null;
    
    /**
     * Instantiates a new Amount and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return Amount
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): Amount {
        return new Amount();
    }

    /**
     * Gets the AdditionalData property value. Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
     * @return array<string, mixed>|null
    */
    public function getAdditionalData(): ?array {
        return $this->additionalData;
    }

    /**
     * Gets the convertedFromCurrency property value. A three-letter ISO 4217 code that indicates the currency of the amount in the <b>convertedFromValue</b> field. This value is required or returned only if currency conversion/localization is required, and represents the pre-conversion currency.
     * @return string|null
    */
    public function getConvertedFromCurrency(): ?string {
        return $this->convertedFromCurrency;
    }

    /**
     * Gets the convertedFromValue property value. The monetary amount before any conversion is performed, in the currency specified by the <b>convertedFromCurrency</b> field. This value is required or returned only if currency conversion/localization is required. The value field contains the converted amount of this value, in the currency specified by the <b>currency</b> field.
     * @return string|null
    */
    public function getConvertedFromValue(): ?string {
        return $this->convertedFromValue;
    }

    /**
     * Gets the currency property value. A three-letter ISO 4217 code that indicates the currency of the amount in the <b>value</b> field. If currency conversion/localization is required, this is the post-conversion currency of the amount in the <b>value</b> field.
     * @return string|null
    */
    public function getCurrency(): ?string {
        return $this->currency;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'convertedFromCurrency' => fn(ParseNode $n) => $o->setConvertedFromCurrency($n->getStringValue()),
            'convertedFromValue' => fn(ParseNode $n) => $o->setConvertedFromValue($n->getStringValue()),
            'currency' => fn(ParseNode $n) => $o->setCurrency($n->getStringValue()),
            'value' => fn(ParseNode $n) => $o->setValue($n->getStringValue()),
        ];
    }

    /**
     * Gets the value property value. The monetary amount, in the currency specified by the <b>currency</b> field. If currency conversion/localization is required, this value is the converted amount, and the <b>convertedFromValue</b> field contains the amount in the original currency.
     * @return string|null
    */
    public function getValue(): ?string {
        return $this->value;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeStringValue('convertedFromCurrency', $this->getConvertedFromCurrency());
        $writer->writeStringValue('convertedFromValue', $this->getConvertedFromValue());
        $writer->writeStringValue('currency', $this->getCurrency());
        $writer->writeStringValue('value', $this->getValue());
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
     * Sets the convertedFromCurrency property value. A three-letter ISO 4217 code that indicates the currency of the amount in the <b>convertedFromValue</b> field. This value is required or returned only if currency conversion/localization is required, and represents the pre-conversion currency.
     * @param string|null $value Value to set for the convertedFromCurrency property.
    */
    public function setConvertedFromCurrency(?string $value): void {
        $this->convertedFromCurrency = $value;
    }

    /**
     * Sets the convertedFromValue property value. The monetary amount before any conversion is performed, in the currency specified by the <b>convertedFromCurrency</b> field. This value is required or returned only if currency conversion/localization is required. The value field contains the converted amount of this value, in the currency specified by the <b>currency</b> field.
     * @param string|null $value Value to set for the convertedFromValue property.
    */
    public function setConvertedFromValue(?string $value): void {
        $this->convertedFromValue = $value;
    }

    /**
     * Sets the currency property value. A three-letter ISO 4217 code that indicates the currency of the amount in the <b>value</b> field. If currency conversion/localization is required, this is the post-conversion currency of the amount in the <b>value</b> field.
     * @param string|null $value Value to set for the currency property.
    */
    public function setCurrency(?string $value): void {
        $this->currency = $value;
    }

    /**
     * Sets the value property value. The monetary amount, in the currency specified by the <b>currency</b> field. If currency conversion/localization is required, this value is the converted amount, and the <b>convertedFromValue</b> field contains the amount in the original currency.
     * @param string|null $value Value to set for the value property.
    */
    public function setValue(?string $value): void {
        $this->value = $value;
    }

}
