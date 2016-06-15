<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
	
	/**
     * @Route("/newparcelorder", name="parcel_order_bs_form")
     */
    public function parcelorderbsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Default:parcelorder.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    /**
     * @Route("/postmanpanel", name="postman_panel")
     */
	public function postmanpanelAction()
	{
		return $this->render('AppBundle:Default:postmanpanel.html.twig');
	}
}
