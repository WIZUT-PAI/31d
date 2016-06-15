<?php
namespace ParcelBundle\Model;

Interface ParcelInterface
{
	public function setidSender($idSender);
	public function getidSender();
	public function setidReceiver($idReceiver);
	public function getidReceiver();
	public function setidPostman($idPostman);
	public function getidPostman();
	public function setNotes($Notes);
	public function getNotes();
	public function setparcelHash($parcelHash);
	public function getparcelHash();
}