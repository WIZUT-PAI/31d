<?php
namespace AppBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Model\PostmanInterface;
use AppBundle\Form\PostmanType;
use AppBundle\Exception\InvalidFormException;

class PostmanFormHandler implements PostmanFormHandlerInterface
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
        $postman = $this->createPostman();
        return $this->processForm($postman, $parameters, 'POST');
    }
    public function put(PostmanInterface $postman, array $parameters)
    {
        return $this->processForm($postman, $parameters, 'PUT');
    }
    private function processForm(PostmanInterface $postman, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create($this->formType, $postman, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);

        if ($form->isValid()) {
            $note = $form->getData();
            $this->repository->save($postman);

            return $postman;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    private function createPostman()
    {
        return new $this->entityClass();
    }
}