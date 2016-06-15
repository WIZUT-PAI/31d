<?php
namespace PostmanBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PostmanController extends FOSRestController 
{
    public function getPostmanAction($id) 
    { 
        return $this->getDoctrine()->getRepository('PostmanBundle:Postman')->find($id);
    }
    public function getPostmenAction() 
    { 
        return $this->getDoctrine()->getRepository('PostmanBundle:Postman')->findAll();
    }
    public function postPostmanAction(Request $request) { }
    public function putPostmanAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();
        $postman = $em->getRepository('PostmanBundle:Postman')->find($id);
        
        if (!$postman) {
            throw $this->createNotFoundException(
                'No postman found for id '.$id
            );
        }

        $postman = $em->getRepository('PostmanBundle:Postman')->edit($request, $postman);
        $em->flush();
    }
    public function deletePostmanAction(Request $request, $id) 
    { 
        $em = $this->getDoctrine()->getManager();
        $postman = $em->getRepository('PostmanBundle:Postman')->find($id);

        if (!$postman) {
            throw $this->createNotFoundException(
                'No postman found for id '.$id
            );
        }

        $em->remove($postman);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
}