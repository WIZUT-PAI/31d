<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PostmanController extends FOSRestController
{
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function getPostmenAction()
    {
        $data = $this->getDoctrine()->getRepository('AppBundle\Entity\Postman')->findAll();
        $view = $this->view($data, 200);
        return $this->handleView($view);
    }
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/postman", name="post_postman")
     */
    public function postPostmenAction(Request $request) {
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
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/postman/{id}", name="put_postman")
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