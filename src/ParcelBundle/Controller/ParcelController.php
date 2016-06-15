<?php

namespace ParcelBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ParcelController extends FOSRestController 
{
	public function getParcelAction($id) {
		$parcel = $this->getDoctrine()->getRepository('ParcelBundle:Parcel')
		->find($id);

    if (!$parcel) {
        throw $this->createNotFoundException(
            'No parcel found for id '.$id
        );
    }

	$response = new JsonResponse();
	$response->setData(array(
    	'id' => $parcel->getId(),
    	'idSender' => $parcel->getIdSender(),
    	'idReceiver' => $parcel->getIdReceiver(),
    	'idPostman' => $parcel->getIdPostman(),
    	'notes' => $parcel->getNotes(),
    	'parcelHash' => $parcel->getParcelHash()
	));

		return $response;
	}
	
	public function getParcelsAction() { }
	public function postParcelAction(Request $request) 
    {
        $parcel = new Parcel();
        $parcel->setIdSender($request->query->get('idSender'));
        $parcel->setIdReceiver($request->query->get('idReceiver'));
        $parcel->setIdPostman($request->query->get('idPostman'));
        $parcel->setNotes($request->query->get('notes'));
        $parcel->setParcelHash($request->query->get('parcelHash'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($parcel);
        $em->flush();
        return new Response('Saved new Parcel with id '.$parcel->getId());
    }
    
	public function putParcelAction(Request $request, $id) 
	{
		try
		{
			$parcel = $this->getDoctrine()->getRepository('ParcelBundle:Parcel')
			->find($id);
			
			if (!$parcel) {
				$statusCode = Response::HTTP_CREATED;
				$parcel = $this->container->get('parcel_rest.parcel_form.handler')
				->post($request->request->all());
			}
			else {
				$statusCode = Response::HTTP_NO_CONTENT;
				$parcel = $this->container->get('parcel_rest.parcel_form.handler')
				->put($parcel,$request->request->all());
			}
			$routeOptions = array(
				'id' => $parcel->getId(),
				'_format' => $request->get('_format')
			);
			return $this->routeRedirectView('api_1_get_parcel',$routeOptions,$statusCode);
		}
		catch (InvalidFormException $exception) 
		{
			return $exception->getForm();
		}
	}
    
	public function deleteParcelAction(Request $request, $id) 
	{ 
		$parcel = $this->getDoctrine()
						->getRepository('ParcelBundle:Parcel')->find($id);
		if ($parcel)
		{
			$this->getDoctrine()
						->getRepository('ParcelBundle:Parcel')->delete($parcel);
		}
		else
		{
			throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
		}
	}
}