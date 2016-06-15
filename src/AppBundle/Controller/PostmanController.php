<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostmanController extends FOSRestController {
    /**
     * @Route("/postman.{_format}", name="get_postman")
     * @Method({"GET"})
     */
    public function postmanAction() 
    {
		$postmans = $this->getDoctrine()->getRepository('AppBundle:Postman')->findAll();
        if (!$postmans) {
            throw $this->createNotFoundException(
                'No postmans found.'
            );
        }

        $postmansarray = array();
        
        foreach($postmans as $onePostman) {
            $postman['id'] = $onePostman->getId();
            $postman['first_name'] = $onePostman->getFirstName();
            $postman['last_name'] = $onePostman->getLastName();
            $postman['phone'] = $onePostman->getPhone();
            $postman['email'] = $onePostman->getEmail();
            $postman['city'] = $onePostman->getCity();
            
            array_push($postmansarray, $postman);
        }


        return new JsonResponse($postmansarray);
	}
    
    /**
     * @Route("/postman.{_format}", name="post_postman")
     * @Method({"POST"})
     */
    public function postPostmanAction(Request $request) {
        try {
            $newPostman = $this->container->get('postman_form.handler')->post($request->request->all());
            $routeOptions = array(
                'id' => $newPostman->getId(),
                '_format' => $request->get('_format')
            );
            return $this->routeRedirectView('get_postman', $routeOptions, Response::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return array('form' => $exception->getForm());
        }
 }
    
    /**
     * @Route("/postman/{id}.{_format}", name="put_postman")
     * @Method({"PUT"})
     */
    public function putPostmanAction(Request $request, $id) {
        try{
            $postman = $this->getDoctrine()->getRepository('AppBundle:Postman')
                          ->find($id);
            if(!$postman)
            {
                $statusCode = Response::HTTP_CREATED;
                $postman = $this->container->get('postman_form.handler')->post($request->request->all());
            }
            else
            {
                $statusCode = Response::HTTP_NO_CONTENT;
                $postman = $this->container->get('postman_form.handler')->put($postman[0],$request->request->all());
            }
            $routeOptions = array('id'=>$postman->getId(),'_format'=>$request->get('_format'));
            return $this->routeRedirectView('get_postman',$routeOptions,$statusCode);
        }
        catch(InvalidFormException $exception){
            return $exception->getForm();
        }
     }
}