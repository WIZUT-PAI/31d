<?php
namespace AppBundle\Model;
Interface ParcelOrderInterface
{
	public function setTracking($tracking);
	public function getTracking();
	public function setParcel(\AppBundle\Entity\Parcel $parcel = null);
	public function getParcel();
	public function setSender(\AppBundle\Entity\AddressData $sender = null);
	public function getSender();
	public function setReceiver(\AppBundle\Entity\AddressData $receiver = null);
	public function getReceiver();
}
