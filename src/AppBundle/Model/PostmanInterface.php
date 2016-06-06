<?php

namespace AppBundle\Model;

Interface PostmanInterface
{
    public function setName($name);
    public function getName();
    public function setPhone($phone);
    public function getPhone();
    public function setEmail($email);
    public function getEmail();
    public function setCity($city);
    public function getCity();     
    public function setUser(\AppBundle\Entity\User $user);
    public function getUser();
}