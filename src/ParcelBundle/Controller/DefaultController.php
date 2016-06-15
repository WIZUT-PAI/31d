<?php

namespace ParcelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ParcelBundle:Default:index.html.twig');
    }
}
