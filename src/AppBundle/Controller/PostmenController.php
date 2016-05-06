<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class PostmenController extends FOSRestController
{
    public function getPostmenAction()
    {		
        $data = $this->getDoctrine()->getRepository('AppBundle:Postman')->findAll();        
		$view = $this->view($data);
        return $this->handleView($view);
    }
    
    
}
