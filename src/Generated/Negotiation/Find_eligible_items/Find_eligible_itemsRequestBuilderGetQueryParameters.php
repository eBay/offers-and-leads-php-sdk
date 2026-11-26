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

namespace EBay\OffersAndLeads\Generated\Negotiation\Find_eligible_items;

/**
 * This method evaluates a seller's current listings and returns the set of IDs that are eligible for a seller-initiated discount offer to a buyer.  <br><br>A listing ID is returned only when one or more buyers have shown an "interest" in the listing.  <br><br>If any buyers have shown interest in a listing, the seller can initiate a "negotiation" with them by calling <a href="/api-docs/sell/negotiation/resources/offer/methods/sendOfferToInterestedBuyers">sendOfferToInterestedBuyers</a>, which sends all interested buyers a message that offers the listing at a discount.  <br><br>For details about how to create seller offers to buyers, see <a href="/api-docs/sell/static/marketing/offers-to-buyers.html" title="Selling Integration Guide">Sending offers to buyers</a>
*/
class Find_eligible_itemsRequestBuilderGetQueryParameters 
{
    /**
     * @var int|null $limit This query parameter specifies the maximum number of items to return from the result set on a page in the paginated response.<br><br><b>Minimum:</b> 1<br><br><b>Maximum:</b> 200<br><br><b>Default: </b>10
    */
    public ?int $limit = null;
    
    /**
     * @var int|null $offset This query parameter specifies the number of results to skip in the result set before returning the first result in the paginated response.  <br><br>Combine <b>offset</b> with the <b>limit</b> query parameter to control the items returned in the response. For example, if you supply an <b>offset</b> of <code>0</code> and a <b>limit</b> of <code>10</code>, the first page of the response contains the first 10 results from the complete list of items retrieved by the call. If <b>offset</b> is <code>10</code> and <b>limit</b> is <code>20</code>, the first page of the response contains items 11-30 from the complete result set. <br><br><b>Default:</b> 0
    */
    public ?int $offset = null;
    
    /**
     * Instantiates a new Find_eligible_itemsRequestBuilderGetQueryParameters and sets the default values.
     * @param int|null $limit This query parameter specifies the maximum number of items to return from the result set on a page in the paginated response.<br><br><b>Minimum:</b> 1<br><br><b>Maximum:</b> 200<br><br><b>Default: </b>10
     * @param int|null $offset This query parameter specifies the number of results to skip in the result set before returning the first result in the paginated response.  <br><br>Combine <b>offset</b> with the <b>limit</b> query parameter to control the items returned in the response. For example, if you supply an <b>offset</b> of <code>0</code> and a <b>limit</b> of <code>10</code>, the first page of the response contains the first 10 results from the complete list of items retrieved by the call. If <b>offset</b> is <code>10</code> and <b>limit</b> is <code>20</code>, the first page of the response contains items 11-30 from the complete result set. <br><br><b>Default:</b> 0
    */
    public function __construct(?int $limit = null, ?int $offset = null) {
        $this->limit = $limit;
        $this->offset = $offset;
    }

}
