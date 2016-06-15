<?php
namespace AppBundle\Handler;
use AppBundle\Model\ParcelInterface;
Interface ParcelFormHandlerInterface
{
    public function post(array $parameters);
}