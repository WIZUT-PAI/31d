<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressDataController extends FOSRestController {

	public function getAddressAction($id) {
		return $this->getDoctrine()->getRepository('AppBundle:AddressData')->find($id);
	}
	
	public function getAddresssAction() { 
		return $this->getDoctrine()->getRepository('AppBundle:AddressData')->findAll();
	}
	
	
	public function postAddressAction(Request $request) {
		try {
			$newAddress = $this->container->get('addressdata_form.handler')->post(	$request->request->all() );
			$routeOptions = array(
				'id' => $newAddress->getId(),
				'_format' => $request->get('_format')
			);
				return $this->routeRedirectView('adr_1_get_address', $routeOptions,Response::HTTP_CREATED);
		} catch (InvalidFormException $exception) {
			return array('form' => $exception->getForm());
		}
	}
	
	
	
	public function putAddressAction(Request $request, $id) { 
		try {
			$address = $this->getDoctrine()->getRepository('AppBundle:AddressData')->find($id);
			if (!$address) {
				$statusCode = Response::HTTP_CREATED;
				$address = $this->container->get('addressdata_form.handler')->post(
					$request->request->all()
					);
			} else {
				$statusCode = Response::HTTP_NO_CONTENT;
				$address = $this->container->get('addressdata_form.handler')->put(
					$address,
					$request->request->all()
					);
			}
			$routeOptions = array(
				'id' => $address->getId(),
				'_format' => $request->get('_format')
			);
			return $this->routeRedirectView(
				'adr_1_get_address',
				$routeOptions,
				$statusCode
			);
		} catch (InvalidFormException $exception) {
			return $exception->getForm();
		}
	}
	
	
	public function deleteAddressAction(Request $request, $id) { 
		$address = $this->getDoctrine()->getRepository('AppBundle:AddressData')->find($id);
		if($address)
		{
			$this->getDoctrine()->getRepository('AppBundle:AddressData')->delete($address);
		}
		else
		{
			throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
		}
	}
}
