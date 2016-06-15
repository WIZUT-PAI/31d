<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParcelorderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parcel', ParcelType::class)
            ->add('sender', AddressDataType::class)
            ->add('receiver', addressDataType::class)
            ->add('tracking')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
	public function configureOptions(OptionsResolver $resolver)
	{
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\ParcelOrder', 
        						  'csrf_protection' => false,
        						  ));
	}
}
