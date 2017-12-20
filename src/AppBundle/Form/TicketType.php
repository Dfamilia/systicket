<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaCreado')->add('fechaStatus')->add('fechaCierre')->add('descripcionProblema')->add('categoria')->add('estado')->add('prioridad')->add('usuarioSolicitanteID')->add('usuarioAsignadoID');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Ticket',
            //se agrega este campo para permitir el uso de envio de datos fuera de symfony (postman)//
            'csrf_protection' => false,
            //se agrega este campo para poder agregar datos al entity despues del debugueo de symfony Form//
            'allow_extra_fields' => true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ticket';
    }


}
