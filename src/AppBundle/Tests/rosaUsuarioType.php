<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName')
            ->add('userLastname')
            ->add('nickname')
            ->add('password')
            ->add('userType')
            ->add('idRol')
            ->add('userStatus')
            /**->add('userCreateDate',  DateType::class,
                array(
                'widget' => 'single_text',  'format' => 'yyyy-MM-dd',))*/
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario',
            'csrf_protection'=>false,
            'allow_extra_fields'=>true
        ));
    }
}
