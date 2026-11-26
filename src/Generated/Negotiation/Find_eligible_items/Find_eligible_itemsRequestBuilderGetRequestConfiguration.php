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

use Microsoft\Kiota\Abstractions\BaseRequestConfiguration;
use Microsoft\Kiota\Abstractions\RequestOption;

/**
 * Configuration for the request such as headers, query parameters, and middleware options.
*/
class Find_eligible_itemsRequestBuilderGetRequestConfiguration extends BaseRequestConfiguration 
{
    /**
     * @var Find_eligible_itemsRequestBuilderGetQueryParameters|null $queryParameters Request query parameters
    */
    public ?Find_eligible_itemsRequestBuilderGetQueryParameters $queryParameters = null;
    
    /**
     * Instantiates a new Find_eligible_itemsRequestBuilderGetRequestConfiguration and sets the default values.
     * @param array<string, array<string>|string>|null $headers Request headers
     * @param array<RequestOption>|null $options Request options
     * @param Find_eligible_itemsRequestBuilderGetQueryParameters|null $queryParameters Request query parameters
    */
    public function __construct(?array $headers = null, ?array $options = null, ?Find_eligible_itemsRequestBuilderGetQueryParameters $queryParameters = null) {
        parent::__construct($headers ?? [], $options ?? []);
        $this->queryParameters = $queryParameters;
    }

    /**
     * Instantiates a new Find_eligible_itemsRequestBuilderGetQueryParameters.
     * @param int|null $limit This query parameter specifies the maximum number of items to return from the result set on a page in the paginated response.<br><br><b>Minimum:</b> 1<br><br><b>Maximum:</b> 200<br><br><b>Default: </b>10
     * @param int|null $offset This query parameter specifies the number of results to skip in the result set before returning the first result in the paginated response.  <br><br>Combine <b>offset</b> with the <b>limit</b> query parameter to control the items returned in the response. For example, if you supply an <b>offset</b> of <code>0</code> and a <b>limit</b> of <code>10</code>, the first page of the response contains the first 10 results from the complete list of items retrieved by the call. If <b>offset</b> is <code>10</code> and <b>limit</b> is <code>20</code>, the first page of the response contains items 11-30 from the complete result set. <br><br><b>Default:</b> 0
     * @return Find_eligible_itemsRequestBuilderGetQueryParameters
    */
    public static function createQueryParameters(?int $limit = null, ?int $offset = null): Find_eligible_itemsRequestBuilderGetQueryParameters {
        return new Find_eligible_itemsRequestBuilderGetQueryParameters($limit, $offset);
    }

}
