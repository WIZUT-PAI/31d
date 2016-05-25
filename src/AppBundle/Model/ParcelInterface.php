<?php
namespace AppBundle\Model;

Interface ParcelInterface
{
	public function getId();
	public function setWeight($weight);
	public function getWeight();
	public function setNote($note);
	public function getNote();
	public function setParcelHash($parcelHash);
	public function getParcelHash();
}