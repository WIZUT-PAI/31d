<?php
namespace AppBundle\Model;
Interface AddressDataInterface
{
	public function setFirstName($firstName);
	public function getFirstName();
	public function setLastName($lastName);
	public function getLastName();
	public function setCity($city);
	public function getCity();
	public function setStreet($street);
	public function getStreet();
	public function setPostalCode($postalCode);
	public function getPostalCode();
	public function setPhone($phone);
	public function getPhone();
	public function setEmail($email);
	public function getEmail();
}
