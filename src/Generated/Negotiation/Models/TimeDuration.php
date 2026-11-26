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
 * A complex type that specifies a period of time using a specified time-measurement unit.
*/
class TimeDuration implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var TimeDurationUnitEnum|null $unit A time-measurement unit that specifies a singular period of time.  <br><br>A span of time is defined when you apply the value specified in the <b>value</b> field to the value specified for <b>unit</b>.  <br><br>Time-measurement units can be YEAR, MONTH, DAY, and so on. See <b>TimeDurationUnitEnum</b> for a complete list of possible time-measurement units.
    */
    private ?TimeDurationUnitEnum $unit = null;
    
    /**
     * @var int|null $value An integer that represents an amount of time, as measured by the time-measurement unit specified in the <b>unit</b> field.
    */
    private ?int $value = null;
    
    /**
     * Instantiates a new TimeDuration and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return TimeDuration
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): TimeDuration {
        return new TimeDuration();
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
            'unit' => fn(ParseNode $n) => $o->setUnit($n->getEnumValue(TimeDurationUnitEnum::class)),
            'value' => fn(ParseNode $n) => $o->setValue($n->getIntegerValue()),
        ];
    }

    /**
     * Gets the unit property value. A time-measurement unit that specifies a singular period of time.  <br><br>A span of time is defined when you apply the value specified in the <b>value</b> field to the value specified for <b>unit</b>.  <br><br>Time-measurement units can be YEAR, MONTH, DAY, and so on. See <b>TimeDurationUnitEnum</b> for a complete list of possible time-measurement units.
     * @return TimeDurationUnitEnum|null
    */
    public function getUnit(): ?TimeDurationUnitEnum {
        return $this->unit;
    }

    /**
     * Gets the value property value. An integer that represents an amount of time, as measured by the time-measurement unit specified in the <b>unit</b> field.
     * @return int|null
    */
    public function getValue(): ?int {
        return $this->value;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeEnumValue('unit', $this->getUnit());
        $writer->writeIntegerValue('value', $this->getValue());
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
     * Sets the unit property value. A time-measurement unit that specifies a singular period of time.  <br><br>A span of time is defined when you apply the value specified in the <b>value</b> field to the value specified for <b>unit</b>.  <br><br>Time-measurement units can be YEAR, MONTH, DAY, and so on. See <b>TimeDurationUnitEnum</b> for a complete list of possible time-measurement units.
     * @param TimeDurationUnitEnum|null $value Value to set for the unit property.
    */
    public function setUnit(?TimeDurationUnitEnum $value): void {
        $this->unit = $value;
    }

    /**
     * Sets the value property value. An integer that represents an amount of time, as measured by the time-measurement unit specified in the <b>unit</b> field.
     * @param int|null $value Value to set for the value property.
    */
    public function setValue(?int $value): void {
        $this->value = $value;
    }

}
