<?php

namespace MerryAdyen;

use Adyen\HttpClient\ClientInterface;
use Adyen\HttpClient\CurlClient;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Client extends \Adyen\Client
{
    const MERRY_MODIFICATION_API_ENDPOINT_TEST = 'https://checkout-test.adyen.com/{version}/payments/{paymentPspReference}/';
    const MERRY_MODIFICATION_API_ENDPOINT_LIVE = 'https://{prefix}-checkout-live.adyenpayments.com/checkout/{version}/payments/{paymentPspReference}/';
    const MERRY_MODIFICATION_API_VERSION = 'v68';

    /**
     * Client constructor.
     *
     * @param ConfigInterface|null $config
     * @throws AdyenException
     */
    public function __construct($config = null)
    {
        parent::__construct($config);
    }

    /**
     * Set environment to connect to test or live platform of Adyen
     * For live please specify the unique identifier.
     *
     * @param string $environment
     * @param string|null $liveEndpointUrlPrefix Provide the unique live url prefix from the "API URLs and Response"
     *                                           menu in the Adyen Customer Area
     * @throws AdyenException
     */
    public function setEnvironment($environment, $liveEndpointUrlPrefix = null)
    {
        parent::setEnvironment($environment, $liveEndpointUrlPrefix);

        if ($environment == \Adyen\Environment::TEST) {
            //  Test environment
            $modificationEndpoint = str_replace('{version}', self::MERRY_MODIFICATION_API_VERSION, self::MERRY_MODIFICATION_API_ENDPOINT_TEST);
            $this->config->set('merry.modificationEndpoint', $modificationEndpoint);
        }
        elseif ($environment == \Adyen\Environment::LIVE) {
            //  Live environment
            if ($liveEndpointUrlPrefix) {
                $modificationEndpoint = str_replace('{prefix}', $liveEndpointUrlPrefix, self::MERRY_MODIFICATION_API_ENDPOINT_LIVE);
                $modificationEndpoint = str_replace('{version}', self::MERRY_MODIFICATION_API_VERSION, $modificationEndpoint);
                $this->config->set('merry.modificationEndpoint', $modificationEndpoint);
            }
            else {
                $this->config->set('merry.modificationEndpoint', null); // not supported please specify unique identifier
            }
        }
        else {
            //  Exception already handled in parent method
        }
    }
}
