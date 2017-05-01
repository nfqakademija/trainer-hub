<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

/**
* Generate Registration form
*/
class RegistrationType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array                $options
    * Build the form
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('roles', CollectionType::class, array(
                    'entry_type' => ChoiceType::class,
                    'entry_options' => array(
                        'choices' => array(
                            'Klientas' => 'ROLE_CLIENT',
                            'Treneris' => 'ROLE_TRAINER',
                        ),
                        'attr' => ['class' => 'form-control'],
                        'label' => false,
                    ),
            ));
    }
    /**
    * Get parent form
    * @return string
    */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
    * Get block prefix
    * @return string
    */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
