<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('current_password');
        $builder->add('name', null, [
            'label' => 'Vardas',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        $builder->add('surname', null, [
            'label' => 'Pavardė',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        $builder->add('city', null, [
            'label' => 'Miestas',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        $builder->add('phone', null, [
            'label' => 'Telefonas',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        $builder->add('description', TextareaType::class, [
            'label' => 'Aprašymas',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        $builder->add('birthday', BirthdayType::class, [
            'label' => 'Gimimo data'
        ]);

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
