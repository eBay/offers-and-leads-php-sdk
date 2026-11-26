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
 * A complex type that describes the value of a monetary amount as represented by a global currency.
*/
class Amount implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var CurrencyCodeEnum|null $currency The base currency applied to the <b>value</b> field to establish a monetary amount.  <br><br>The currency is represented as a 3-letter <a href="http://www.currency-iso.org/en/home/tables/table-a1.html" title="www.currency-iso.org" target="_blank">ISO4217</a> currency code. For example, the code for the Canadian Dollar is <code>CAD</code>.  <br><br><b>Default:</b> The default currency of the eBay marketplace that hosts the listing.
    */
    private ?CurrencyCodeEnum $currency = null;
    
    /**
     * @var string|null $value The monetary amount in the specified <b>currency</b>.<br><br><div class="msgbox_important"><p class="msgbox_importantInDiv" data-mc-autonum="&lt;b&gt;&lt;span style=&quot;color: #dd1e31;&quot; class=&quot;mcFormatColor&quot;&gt;Important! &lt;/span&gt;&lt;/b&gt;"><span class="autonumber"><span><b><span style="color: #dd1e31;" class="mcFormatColor">Important!</span></b></span></span> For listings on the following marketplaces, a comma (<code>,</code>) must be used as the decimal separator:<br><ul><li>France</li><li>Canada (French Language)</li><li>Germany</li><li>Italy</li><li>Spain</li></ul>All other sites should use a period (<code>.</code>) as the decimal separator. If the incorrect decimal separator is used, the decimal point will be ignored.</p></div>
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
     * Gets the currency property value. The base currency applied to the <b>value</b> field to establish a monetary amount.  <br><br>The currency is represented as a 3-letter <a href="http://www.currency-iso.org/en/home/tables/table-a1.html" title="www.currency-iso.org" target="_blank">ISO4217</a> currency code. For example, the code for the Canadian Dollar is <code>CAD</code>.  <br><br><b>Default:</b> The default currency of the eBay marketplace that hosts the listing.
     * @return CurrencyCodeEnum|null
    */
    public function getCurrency(): ?CurrencyCodeEnum {
        return $this->currency;
    }

    /**
     * The deserialization information for the current model
     * @return array<string, callable(ParseNode): void>
    */
    public function getFieldDeserializers(): array {
        $o = $this;
        return  [
            'currency' => fn(ParseNode $n) => $o->setCurrency($n->getEnumValue(CurrencyCodeEnum::class)),
            'value' => fn(ParseNode $n) => $o->setValue($n->getStringValue()),
        ];
    }

    /**
     * Gets the value property value. The monetary amount in the specified <b>currency</b>.<br><br><div class="msgbox_important"><p class="msgbox_importantInDiv" data-mc-autonum="&lt;b&gt;&lt;span style=&quot;color: #dd1e31;&quot; class=&quot;mcFormatColor&quot;&gt;Important! &lt;/span&gt;&lt;/b&gt;"><span class="autonumber"><span><b><span style="color: #dd1e31;" class="mcFormatColor">Important!</span></b></span></span> For listings on the following marketplaces, a comma (<code>,</code>) must be used as the decimal separator:<br><ul><li>France</li><li>Canada (French Language)</li><li>Germany</li><li>Italy</li><li>Spain</li></ul>All other sites should use a period (<code>.</code>) as the decimal separator. If the incorrect decimal separator is used, the decimal point will be ignored.</p></div>
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
        $writer->writeEnumValue('currency', $this->getCurrency());
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
     * Sets the currency property value. The base currency applied to the <b>value</b> field to establish a monetary amount.  <br><br>The currency is represented as a 3-letter <a href="http://www.currency-iso.org/en/home/tables/table-a1.html" title="www.currency-iso.org" target="_blank">ISO4217</a> currency code. For example, the code for the Canadian Dollar is <code>CAD</code>.  <br><br><b>Default:</b> The default currency of the eBay marketplace that hosts the listing.
     * @param CurrencyCodeEnum|null $value Value to set for the currency property.
    */
    public function setCurrency(?CurrencyCodeEnum $value): void {
        $this->currency = $value;
    }

    /**
     * Sets the value property value. The monetary amount in the specified <b>currency</b>.<br><br><div class="msgbox_important"><p class="msgbox_importantInDiv" data-mc-autonum="&lt;b&gt;&lt;span style=&quot;color: #dd1e31;&quot; class=&quot;mcFormatColor&quot;&gt;Important! &lt;/span&gt;&lt;/b&gt;"><span class="autonumber"><span><b><span style="color: #dd1e31;" class="mcFormatColor">Important!</span></b></span></span> For listings on the following marketplaces, a comma (<code>,</code>) must be used as the decimal separator:<br><ul><li>France</li><li>Canada (French Language)</li><li>Germany</li><li>Italy</li><li>Spain</li></ul>All other sites should use a period (<code>.</code>) as the decimal separator. If the incorrect decimal separator is used, the decimal point will be ignored.</p></div>
     * @param string|null $value Value to set for the value property.
    */
    public function setValue(?string $value): void {
        $this->value = $value;
    }

}
