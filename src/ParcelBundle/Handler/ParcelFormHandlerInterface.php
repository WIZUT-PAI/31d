<?php
namespace ParcelBundle\Handler;
use ParcelBundle\Model\ParcelInterface;

Interface ParcelFormHandlerInterface
{
	public function post(array $parameters);
	public function put(ParcelInterface $parcel, array $parameters);
}