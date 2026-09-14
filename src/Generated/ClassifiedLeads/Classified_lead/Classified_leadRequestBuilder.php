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

namespace EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead;

use EBay\OffersAndLeads\Generated\ClassifiedLeads\Classified_lead\Item\WithItemItemRequestBuilder;
use EBay\OffersAndLeads\Generated\ClassifiedLeads\Models\ClassifiedLeadsListResponse;
use Exception;
use Http\Promise\Promise;
use Microsoft\Kiota\Abstractions\BaseRequestBuilder;
use Microsoft\Kiota\Abstractions\HttpMethod;
use Microsoft\Kiota\Abstractions\RequestAdapter;
use Microsoft\Kiota\Abstractions\RequestInformation;

/**
 * Builds and executes requests for operations under /classified_lead
*/
class Classified_leadRequestBuilder extends BaseRequestBuilder 
{
    /**
     * Gets an item from the EBay/OffersAndLeads/Generated/ClassifiedLeads.classified_lead.item collection
     * @param string $itemId The unique identifier of the listing.
     * @return WithItemItemRequestBuilder
    */
    public function byItemId(string $itemId): WithItemItemRequestBuilder {
        $urlTplParams = $this->pathParameters;
        $urlTplParams['itemId'] = $itemId;
        return new WithItemItemRequestBuilder($urlTplParams, $this->requestAdapter);
    }

    /**
     * Instantiates a new Classified_leadRequestBuilder and sets the default values.
     * @param array<string, mixed>|string $pathParametersOrRawUrl Path parameters for the request or a String representing the raw URL.
     * @param RequestAdapter $requestAdapter The request adapter to use to execute the requests.
    */
    public function __construct($pathParametersOrRawUrl, RequestAdapter $requestAdapter) {
        parent::__construct($requestAdapter, [], '{+baseurl}/classified_lead{?endTime*,includeMessages*,startTime*,status*}');
        if (is_array($pathParametersOrRawUrl)) {
            $this->pathParameters = $pathParametersOrRawUrl;
        } else {
            $this->pathParameters = ['request-raw-url' => $pathParametersOrRawUrl];
        }
    }

    /**
     * This method retrieves leads for all of the seller's active classified ad listings. Optionally, just those matching specified filter criteria can be returned.<p><span class="tablenote"><strong>Note:</strong> This is a <a href="https://developer.ebay.com/develop/guides-v2/using-ebay-restful-apis#versioning-and-the-api-lifecycle" target="_blank"> <img src="/cms/img/docs/partners-api.svg" class="legend-icon partners-icon" title="Limited Release"  alt="Limited Release" />(Limited Release)</a> API available only to select developers approved by business units. For information on how to obtain access to this API in production, please contact eBay support.</span></p>
     * @param Classified_leadRequestBuilderGetRequestConfiguration|null $requestConfiguration Configuration for the request such as headers, query parameters, and middleware options.
     * @return Promise<ClassifiedLeadsListResponse|null>
     * @throws Exception
    */
    public function get(?Classified_leadRequestBuilderGetRequestConfiguration $requestConfiguration = null): Promise {
        $requestInfo = $this->toGetRequestInformation($requestConfiguration);
        return $this->requestAdapter->sendAsync($requestInfo, [ClassifiedLeadsListResponse::class, 'createFromDiscriminatorValue'], null);
    }

    /**
     * This method retrieves leads for all of the seller's active classified ad listings. Optionally, just those matching specified filter criteria can be returned.<p><span class="tablenote"><strong>Note:</strong> This is a <a href="https://developer.ebay.com/develop/guides-v2/using-ebay-restful-apis#versioning-and-the-api-lifecycle" target="_blank"> <img src="/cms/img/docs/partners-api.svg" class="legend-icon partners-icon" title="Limited Release"  alt="Limited Release" />(Limited Release)</a> API available only to select developers approved by business units. For information on how to obtain access to this API in production, please contact eBay support.</span></p>
     * @param Classified_leadRequestBuilderGetRequestConfiguration|null $requestConfiguration Configuration for the request such as headers, query parameters, and middleware options.
     * @return RequestInformation
    */
    public function toGetRequestInformation(?Classified_leadRequestBuilderGetRequestConfiguration $requestConfiguration = null): RequestInformation {
        $requestInfo = new RequestInformation();
        $requestInfo->urlTemplate = $this->urlTemplate;
        $requestInfo->pathParameters = $this->pathParameters;
        $requestInfo->httpMethod = HttpMethod::GET;
        if ($requestConfiguration !== null) {
            $requestInfo->addHeaders($requestConfiguration->headers);
            if ($requestConfiguration->queryParameters !== null) {
                $requestInfo->setQueryParameters($requestConfiguration->queryParameters);
            }
            $requestInfo->addRequestOptions(...$requestConfiguration->options);
        }
        $requestInfo->tryAddHeader('Accept', "application/json");
        return $requestInfo;
    }

    /**
     * Returns a request builder with the provided arbitrary URL. Using this method means any other path or query parameters are ignored.
     * @param string $rawUrl The raw URL to use for the request builder.
     * @return Classified_leadRequestBuilder
    */
    public function withUrl(string $rawUrl): Classified_leadRequestBuilder {
        return new Classified_leadRequestBuilder($rawUrl, $this->requestAdapter);
    }

}
