<?php
/**
 * Created by PhpStorm.
 * User: kgurgul
 * Date: 2015-10-12
 * Time: 21:26
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('method', 'choice', array(
                'choices' => array(
                    'GET' => 'GET',
                    'POST' => 'POST',
                    'PUT' => 'PUT',
                    'DELETE' => 'DELETE',
                    'HEAD' => 'HEAD',
                    'CONNECT' => 'CONNECT',
                    'OPTIONS' => 'OPTIONS',
                    'TRACE' => 'TRACE'),
                'label' => 'Request method',
            ))
            ->add('responseStatus', 'integer', array(
                'data' => '200',
            ))
            ->add('headers', 'collection', array(
                'type' => new HeaderType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false
            ))
            ->add('body', 'textarea', array(
                'required' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mock',
        ));
    }

    public function getName()
    {
        return 'mock';
    }
}