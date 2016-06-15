<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SenderController extends FOSRestController
{
    /**
     * @Route("/sender.{_format}", name="sender")
     * @Method({"GET"})
     */
    public function senderAction() 
    {
		$senders = $this->getDoctrine()->getRepository('AppBundle:Sender')->findAll();

    if (!$senders) {
        throw $this->createNotFoundException(
            'No postman tasks found.'
        );
    }

	$taskarray = array();
	
	foreach($senders as $sender) {
    	$Task['id'] = $sender->getId();
    	$Task['parcel_order'] = $sender->getParcelOrder()->getId();
    	$postman = $this->getDoctrine()->getRepository('AppBundle:Postman')->findOneById($sender->getPostman()->getId());
    	$Task['postman'] = $postman->getFirstName()." ".$postman->getLastName();
    	$Task['done'] = $sender->getDone();
    	
    	array_push($taskarray, $Task);
	}

	return new JsonResponse($taskarray);
	}
	
	/**
     * @Route("/senderpanel.{_format}", name="sender_panel")
     * @Method({"GET"})
     */
    public function senderpanelAction() 
    {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$senders = $this->getDoctrine()->getRepository('AppBundle:sender')->findTaskByPostman($user->getId());

	    if (!$senders) {
		   throw $this->createNotFoundException(
		       'No postman tasks found.'
		   );
	    }

		$taskarray = array();
	
		foreach($senders as $sender) {
	    	$sender = $parcelorder->getSender();
	    	$Task['sender'] = $sender->getFirstName()." ".$sender->getLastName();
	    	
	    	array_push($senderarray, $Sender);
		}

		return new JsonResponse($senderarray);
	}
}