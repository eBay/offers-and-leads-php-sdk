<?php

namespace EBay\OffersAndLeads\Generated\SellLeads\Models;

use Microsoft\Kiota\Abstractions\Serialization\AdditionalDataHolder;
use Microsoft\Kiota\Abstractions\Serialization\Parsable;
use Microsoft\Kiota\Abstractions\Serialization\ParseNode;
use Microsoft\Kiota\Abstractions\Serialization\SerializationWriter;

/**
 * This type contains the classified lead ID and other information.
*/
class ClassifiedLead implements AdditionalDataHolder, Parsable 
{
    /**
     * @var array<string, mixed>|null $additionalData Stores additional data not described in the OpenAPI description found when deserializing. Can be used for serialization as well.
    */
    private ?array $additionalData = null;
    
    /**
     * @var string|null $itemId The unique identifier of the listing.
    */
    private ?string $itemId = null;
    
    /**
     * @var string|null $itemTitle The title of the listing.<br><br><b>Max length:</b> 80.
    */
    private ?string $itemTitle = null;
    
    /**
     * @var array<ClassifiedLeadResponses>|null $responses An array of the classified lead responses.
    */
    private ?array $responses = null;
    
    /**
     * Instantiates a new ClassifiedLead and sets the default values.
    */
    public function __construct() {
        $this->setAdditionalData([]);
    }

    /**
     * Creates a new instance of the appropriate class based on discriminator value
     * @param ParseNode $parseNode The parse node to use to read the discriminator value and create the object
     * @return ClassifiedLead
    */
    public static function createFromDiscriminatorValue(ParseNode $parseNode): ClassifiedLead {
        return new ClassifiedLead();
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
            'itemId' => fn(ParseNode $n) => $o->setItemId($n->getStringValue()),
            'itemTitle' => fn(ParseNode $n) => $o->setItemTitle($n->getStringValue()),
            'responses' => fn(ParseNode $n) => $o->setResponses($n->getCollectionOfObjectValues([ClassifiedLeadResponses::class, 'createFromDiscriminatorValue'])),
        ];
    }

    /**
     * Gets the itemId property value. The unique identifier of the listing.
     * @return string|null
    */
    public function getItemId(): ?string {
        return $this->itemId;
    }

    /**
     * Gets the itemTitle property value. The title of the listing.<br><br><b>Max length:</b> 80.
     * @return string|null
    */
    public function getItemTitle(): ?string {
        return $this->itemTitle;
    }

    /**
     * Gets the responses property value. An array of the classified lead responses.
     * @return array<ClassifiedLeadResponses>|null
    */
    public function getResponses(): ?array {
        return $this->responses;
    }

    /**
     * Serializes information the current object
     * @param SerializationWriter $writer Serialization writer to use to serialize this model
    */
    public function serialize(SerializationWriter $writer): void {
        $writer->writeStringValue('itemId', $this->getItemId());
        $writer->writeStringValue('itemTitle', $this->getItemTitle());
        $writer->writeCollectionOfObjectValues('responses', $this->getResponses());
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
     * Sets the itemId property value. The unique identifier of the listing.
     * @param string|null $value Value to set for the itemId property.
    */
    public function setItemId(?string $value): void {
        $this->itemId = $value;
    }

    /**
     * Sets the itemTitle property value. The title of the listing.<br><br><b>Max length:</b> 80.
     * @param string|null $value Value to set for the itemTitle property.
    */
    public function setItemTitle(?string $value): void {
        $this->itemTitle = $value;
    }

    /**
     * Sets the responses property value. An array of the classified lead responses.
     * @param array<ClassifiedLeadResponses>|null $value Value to set for the responses property.
    */
    public function setResponses(?array $value): void {
        $this->responses = $value;
    }

}
