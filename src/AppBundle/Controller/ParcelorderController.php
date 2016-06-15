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

class ParcelorderController extends FOSRestController {
    
    /**
     * @Route("/parcelorder/{id}.{_format}", name="get_parcelorder")
     * @Method({"GET"})
     * @var integer $id
     */
	public function getParcelorderAction($id) {
		$parcelorder = $this->getDoctrine()->getRepository('AppBundle:ParcelOrder')->find($id);
		
		if (!$parcelorder) {
        		throw $this->createNotFoundException('No parcel order found.');
        	}
		$parcel = $this->getDoctrine()->getRepository('AppBundle:Parcel')->find($parcelorder[0]->getParcel());
		$sender = $this->getDoctrine()->getRepository('AppBundle:AddressData')->find($parcelorder[0]->getSender());
		$receiver = $this->getDoctrine()->getRepository('AppBundle:AddressData')->find($parcelorder[0]->getReceiver());
		$order['parcel']=$parcel->getId();
		$order['sender']=$sender->getId();
		$order['receiver']=$receiver->getId();
		$order['tracking']=$parcelorder[0]->getTracking();
		return new JsonResponse($order);
	}
    
    /**
     * @Route("/parcelorder.{_format}", name="post_parcelorder")
     * @Method({"POST"})
     * @return FormTypeInterface|View
     */
	public function ParcelorderAction(Request $request) {
		try {
			$newParcelorder = $this->container->get('parcelorder_form.handler')->post($request->request->all());
			$routeOptions = array(
 			'id' => $newParcelorder->getId(),
 			'_format' => $request->get('_format')
 			);
			return $this->redirectToRoute('get_parcelorder', ['id' => $newParcelorder->getId(), '_format' => $request->get('_format')]);
 		} catch (InvalidFormException $exception) {
 			return array('form' => $exception->getForm());
 		}
 	}                                                               
}
