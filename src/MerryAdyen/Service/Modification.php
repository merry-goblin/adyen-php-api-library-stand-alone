<?php

namespace MerryAdyen\Service;

class Modification extends \Adyen\Service
{
    /**
     * @var ResourceModel\Modification\Refund
     */
    protected $refund;

    /**
     * @var ResourceModel\Modification\Reversal
     */
    protected $reversal;

    /**
     * Modification constructor.
     *
     * @param \Adyen\Client $client
     * @throws \Adyen\AdyenException
     */
    public function __construct(\Adyen\Client $client)
    {
        parent::__construct($client);
        $this->refund = new \MerryAdyen\Service\ResourceModel\Modification\Refund($this);
        $this->reversal = new \MerryAdyen\Service\ResourceModel\Modification\Reversal($this);
    }

    /**
     * @param $params
     * @param null $requestOptions
     * @return mixed
     * @throws \Adyen\AdyenException
     */
    public function refund($params, $requestOptions = null, $paymentPspReference)
    {
        //  Complete endpoint
        $this->refund->addPaymentPspReference($paymentPspReference);

        //  Refund
        $result = $this->refund->request($params, $requestOptions);
        return $result;
    }

    /**
     * @param $params
     * @param null $requestOptions
     * @return mixed
     * @throws \Adyen\AdyenException
     */
    public function reversal($params, $requestOptions = null, $paymentPspReference)
    {
        //  Complete endpoint
        $this->refund->addPaymentPspReference($paymentPspReference);

        //  Refund
        $result = $this->reversal->request($params, $requestOptions);
        return $result;
    }

}
