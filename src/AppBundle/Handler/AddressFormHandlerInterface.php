<?php
namespace AppBundle\Handler;
use AppBundle\Model\AddressDataInterface;
Interface AddressFormHandlerInterface
{
	public function post(array $parameters);
	public function put(AddressDataInterface $address, array $parameters);
}
