<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostmantaskController extends FOSRestController
{
    /**
     * @Route("/postmantask.{_format}", name="postmantask")
     * @Method({"GET"})
     */
    public function postmantaskAction() 
    {
		$postmantasks = $this->getDoctrine()->getRepository('AppBundle:PostmanTask')->findAll();

    if (!$postmantasks) {
        throw $this->createNotFoundException(
            'No postman tasks found.'
        );
    }

	$taskarray = array();
	
	foreach($postmantasks as $postmantask) {
    	$Task['id'] = $postmantask->getId();
    	$Task['parcel_order'] = $postmantask->getParcelOrder()->getId();
    	$postman = $this->getDoctrine()->getRepository('AppBundle:Postman')->findOneById($postmantask->getPostman()->getId());
    	$Task['postman'] = $postman->getFirstName()." ".$postman->getLastName();
    	$Task['done'] = $postmantask->getDone();
    	
    	array_push($taskarray, $Task);
	}

	return new JsonResponse($taskarray);
	}
	
	/**
     * @Route("/postmantaskpanel.{_format}", name="postman_task_panel")
     * @Method({"GET"})
     */
    public function postmantaskpanelAction() 
    {
		$user = $this->get('security.token_storage')->getToken()->getUser();
		$postmantasks = $this->getDoctrine()->getRepository('AppBundle:PostmanTask')->findTaskByPostman($user->getId());

	    if (!$postmantasks) {
		   throw $this->createNotFoundException(
		       'No postman tasks found.'
		   );
	    }

		$taskarray = array();
	
		foreach($postmantasks as $postmantask) {
	    	$Task['id'] = $postmantask->getId();
	    	$Task['parcel_order'] = $postmantask->getParcelOrder()->getId();
	    	$parcelorder = $this->getDoctrine()->getRepository('AppBundle:ParcelOrder')->findOneById($postmantask->getParcelOrder());
	    	$sender = $parcelorder->getSender();
	    	$receiver = $parcelorder->getReceiver();
	    	$Task['receiver'] = $receiver->getFirstName()." ".$receiver->getLastName();
	    	$Task['receiver_address'] = $receiver->getCity()." ".$receiver->getStreet()." ".$receiver->getPostalCode();
	    	$Task['receiver_phone'] = $receiver->getPhone();
	    	$Task['sender'] = $sender->getFirstName()." ".$sender->getLastName();
	    	$postman = $this->getDoctrine()->getRepository('AppBundle:Postman')->findOneById($postmantask->getPostman()->getId());
	    	$Task['postman'] = $postman->getFirstName()." ".$postman->getLastName();
	    	$Task['done'] = $postmantask->getDone();
	    	
	    	array_push($taskarray, $Task);
		}

		return new JsonResponse($taskarray);
	}
}
