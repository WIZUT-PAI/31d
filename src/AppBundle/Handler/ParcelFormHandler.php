<?php

namespace AppBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Model\ParcelInterface;
use AppBundle\Form\ParcelType;
use AppBundle\Exception\InvalidFormException;

class ParcelFormHandler implements ParcelFormHandlerInterface
{
    private $entityClass;
    private $repository;
    private $formFactory;
    private $formType;
	
    public function __construct(ObjectManager $om, $entityClass,FormFactoryInterface $formFactory, $formType)
    {
        $this->entityClass = $entityClass;
        $this->repository = $om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
        $this->formType = $formType;
    }
	
    public function post(array $parameters)
    {
        $parcel = $this->createParcel();
        return $this->processForm($parcel, $parameters, 'POST');
    }
	
    private function processForm(ParcelInterface $parcel, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create($this->formType, $parcel, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {
            $note = $form->getData();
            $this->repository->save($parcel);
            return $parcel;
		}
        throw new InvalidFormException('Invalid submitted data', $form);
    }
	
    private function createParcel()
    {
        return new $this->entityClass();
    }
}