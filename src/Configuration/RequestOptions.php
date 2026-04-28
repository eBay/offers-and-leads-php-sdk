<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Configuration;

final class RequestOptions
{
    /** @param array<string,string> $headers */
    public function __construct(public array $headers = []) {}
}
