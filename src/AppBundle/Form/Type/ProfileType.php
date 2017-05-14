<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\City;
use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
* Generate Profile edit form
*/
class ProfileType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array                $options
    * Build the form
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->remove('current_password');
        $builder->add('name', null, [
            'label' => 'Vardas',
            'attr' => [
                'class' => 'form-control',
            ],
        ]);
        $builder->add('city', EntityType::class, [
            'class' => City::class,
            'label' => 'Miestas',
        ]);
        $builder->add('phone', null, [
            'label' => 'Telefonas',
            'attr' => [
                'class' => 'form-control',
            ],
        ]);
        if (in_array('ROLE_TRAINER', $options['role'])) {
            $builder->add(
                'avatarFile',
                VichImageType::class,
                array(
                    'label' => 'Nuotrauka',
                    'data_class' => null,
                    'allow_delete' => false,
                    'download_link' => false,
                )
            );
            $builder->add('description', TextareaType::class, [
                'label' => 'Aprašymas',
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'height: 150px',
                ],
            ]);
        }
    }
    /**
    * @param OptionsResolver $resolver
    * Form options
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'role' => 'ROLE_USER',
        ));
    }

    /**
    * Get parent form
    * @return string
    */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    /**
    * Get block prefix
    * @return string
    */
    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
