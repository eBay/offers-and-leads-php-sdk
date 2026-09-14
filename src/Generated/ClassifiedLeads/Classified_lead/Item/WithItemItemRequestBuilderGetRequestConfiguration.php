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

namespace EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead\Item;

use Microsoft\Kiota\Abstractions\BaseRequestConfiguration;
use Microsoft\Kiota\Abstractions\RequestOption;

/**
 * Configuration for the request such as headers, query parameters, and middleware options.
*/
class WithItemItemRequestBuilderGetRequestConfiguration extends BaseRequestConfiguration 
{
    /**
     * @var WithItemItemRequestBuilderGetQueryParameters|null $queryParameters Request query parameters
    */
    public ?WithItemItemRequestBuilderGetQueryParameters $queryParameters = null;
    
    /**
     * Instantiates a new WithItemItemRequestBuilderGetRequestConfiguration and sets the default values.
     * @param array<string, array<string>|string>|null $headers Request headers
     * @param array<RequestOption>|null $options Request options
     * @param WithItemItemRequestBuilderGetQueryParameters|null $queryParameters Request query parameters
    */
    public function __construct(?array $headers = null, ?array $options = null, ?WithItemItemRequestBuilderGetQueryParameters $queryParameters = null) {
        parent::__construct($headers ?? [], $options ?? []);
        $this->queryParameters = $queryParameters;
    }

    /**
     * Instantiates a new WithItemItemRequestBuilderGetQueryParameters.
     * @param string|null $endTime Use with <b>startTime</b> to limit the returned leads for the user for active listings. Only leads with a creation date less than or equal to the specified date and time will be returned. <p><span class="tablenote"><span style="color:#004680"><strong>Note: </strong>The <b>startTime</b> and <b>endTime</b> fields can be used independently to filter results.</span></p>The time stamp must be formatted as an <a href="https://www.iso.org/iso-8601-date-and-time-format.html" target="_blank">ISO 8601</a> string, which is based on the 24-hour Universal Coordinated Time (UTC) clock. <br><br><b>Format:</b> <code>[YYYY]-[MM]-[DD]T[hh]:[mm]:[SS]Z</code> <br><b>Example:</b>  <code>2025-01-10T15:54:00Z</code>
     * @param string|null $includeMessages Include this field and set it to true to retrieve any member messages associated with leads in the <b>memberMessage</b> container (<code>true</code> returns messages).<br><br><b>Default</b>: <code>true</code>
     * @param string|null $startTime Use with <b>endTime</b> to limit the returned leads for the user. Only leads with a start time greater than or equal to the specified date and time will be returned. <p><span class="tablenote"><span style="color:#004680"><strong>Note: </strong>The <b>startTime</b> and <b>endTime</b> fields can be used independently to filter results.</span></p>The time stamp must be formatted as an <a href="https://www.iso.org/iso-8601-date-and-time-format.html" target="_blank">ISO 8601</a> string, which is based on the 24-hour Universal Coordinated Time (UTC) clock.<br><br><b>Format:</b> <code>[YYYY]-[MM]-[DD]T[hh]:[mm]:[SS]Z</code> <br><b>Example:</b>  <code>2025-01-10T15:54:00Z</code>
     * @param string|null $status Include this field if you would only like to retrieve leads where the buyer has answered questions or has not answered questions. If not used, leads with answered questions and unanswered questions are returned. Valid values include: <br><ul><li><code>Answered</code></li> <li><code>Unanswered</code></li></ul>
     * @return WithItemItemRequestBuilderGetQueryParameters
    */
    public static function createQueryParameters(?string $endTime = null, ?string $includeMessages = null, ?string $startTime = null, ?string $status = null): WithItemItemRequestBuilderGetQueryParameters {
        return new WithItemItemRequestBuilderGetQueryParameters($endTime, $includeMessages, $startTime, $status);
    }

}
