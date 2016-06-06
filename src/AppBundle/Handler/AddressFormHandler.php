<?php
namespace AppBundle\Handler;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Model\AddressDataInterface;
use AppBundle\Form\AddressDataType;

use AppBundle\Exception\InvalidFormException;

class AddressFormHandler implements AddressFormHandlerInterface
{
	private $entityClass;
	private $repository;
	private $formFactory;
	private $formType;
	
	public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory, $formType)
	{
		$this->entityClass = $entityClass;
		$this->repository = $om->getRepository($this->entityClass);
		$this->formFactory = $formFactory;
		$this->formType = $formType;
	}
	
	public function post(array $parameters)
	{
		$address = $this->createAddress();
		return $this->processForm($address, $parameters, 'POST');
	}
	public function put(AddressDataInterface $address, array $parameters)
	{
		return $this->processForm($address, $parameters, 'PUT');
	}
	private function processForm(AddressDataInterface $address, array $parameters, $method = "PUT")
	{
		$form = $this->formFactory->create($this->formType, $address, array('method' => $method));
		$form->submit($parameters, 'PATCH' !== $method);
		if ($form->isValid()) {
			$note = $form->getData();
			$this->repository->save($address);
			
			return $address;
		}
		
		throw new InvalidFormException('Invalid submitted data', $form);
		
	}

	private function createAddress()
	{
		return new $this->entityClass();
	}
}
