<?php
namespace AppBundle\Handler;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Model\ParcelorderInterface;
use AppBundle\Form\ParcelorderType;
use AppBundle\Exception\InvalidFormException;
class ParcelorderFormHandler implements ParcelorderFormHandlerInterface
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
        $parcelorder = $this->createParcelorder();
        return $this->processForm($parcelorder, $parameters, 'POST');
    }
    private function processForm(ParcelorderInterface $parcelorder, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create($this->formType, $parcelorder, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {
            $note = $form->getData();
            $this->repository->save($parcelorder);
            return $parcelorder;
		}
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    private function createParcelorder()
    {
        return new $this->entityClass();
    }
}
