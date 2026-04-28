<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Configuration;

use Http\Promise\FulfilledPromise;
use Http\Promise\Promise;
use Microsoft\Kiota\Abstractions\Authentication\AccessTokenProvider;
use Microsoft\Kiota\Abstractions\Authentication\AllowedHostsValidator;

final class KiotaAuthProvider implements AccessTokenProvider
{
    private readonly AllowedHostsValidator $allowedHostsValidator;

    public function __construct(private readonly OffersAndLeadsConfiguration $config)
    {
        $this->allowedHostsValidator = new AllowedHostsValidator($config->getAllowedHosts());
    }

    public function getAuthorizationTokenAsync(string $url, array $additionalAuthenticationContext = []): Promise
    {
        $token = TokenContext::get() ?? $this->config->accessToken;
        if ($token === null) {
            throw new \RuntimeException(
                'No access token. Pass $accessToken per-call or set OffersAndLeadsConfiguration::$accessToken.'
            );
        }
        return new FulfilledPromise($token);
    }

    public function getAllowedHostsValidator(): AllowedHostsValidator
    {
        return $this->allowedHostsValidator;
    }
}
