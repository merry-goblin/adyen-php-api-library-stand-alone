<?php

namespace MerryAdyen\Service;

use Adyen\Service\AbstractResource as MainAbstractResource;

abstract class AbstractResource extends MainAbstractResource
{
	public function addPaymentPspReference($paymentPspReference)
	{
		$this->endpoint = str_replace('{paymentPspReference}', $paymentPspReference, $this->endpoint);
	}
}
