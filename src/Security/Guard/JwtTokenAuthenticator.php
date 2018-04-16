<?php

namespace App\Security\Guard;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator as BaseAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\CookieTokenExtractor;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\QueryParameterTokenExtractor;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;

class JwtTokenAuthenticator extends BaseAuthenticator
{
    /**
     * @return AuthorizationHeaderTokenExtractor|TokenExtractorInterface
     */
    protected function getTokenExtractor()
    {
        // Return a custom extractor, no matter of what are configured
        return new AuthorizationHeaderTokenExtractor('', 'Authorization');

        // Or retrieve the chain token extractor for mapping/unmapping extractors for this authenticator
        $chainExtractor =  parent::getTokenExtractor();

        // Clear the token extractor map from all configured extractors
        $chainExtractor->clearMap();
        // Or only remove a specific extractor
        $chainTokenExtractor->removeExtractor(function (TokenExtractorInterface $extractor) {
            return $extractor instanceof CookieTokenExtractor;
        });

        // Add a new query parameter extractor to the configured ones
        $chainExtractor->addExtractor(new QueryParameterTokenExtractor('jwt'));

        // Return the chain token extractor with the new map
        return $chainTokenExtractor;
    }
}