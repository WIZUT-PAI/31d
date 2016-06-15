<?php
namespace AppBundle\Handler;

use AppBundle\Model\PostmanInterface;

Interface PostmanFormHandlerInterface
{
    public function post(array $parameters);
    public function put(PostmanInterface $postman, array $parameters);
}