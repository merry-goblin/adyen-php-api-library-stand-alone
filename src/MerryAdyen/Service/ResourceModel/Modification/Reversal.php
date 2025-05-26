<?php

namespace MerryAdyen\Service\ResourceModel\Modification;

class Reversal extends \MerryAdyen\Service\AbstractResource
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Include applicationInfo key in the request parameters
     *
     * @var bool
     */
    protected $allowApplicationInfo = false;

    /**
     * Refund constructor.
     *
     * @param \Adyen\Service $service
     */
    public function __construct($service)
    {
        $this->endpoint = $service->getClient()->getConfig()->get('merry.modificationEndpoint').'/reversals';
        parent::__construct($service, $this->endpoint, $this->allowApplicationInfo);
    }
}
