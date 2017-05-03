<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Category;
use AppBundle\Entity\City;
use AppBundle\Entity\Training;
use AppBundle\Entity\TrainingTime;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
* Generate new trainingTime form
*/
class TrainingType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array                $options
    * Build the form
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Pavadinimas',
            ])
            ->add('price', MoneyType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Kaina',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' => 'Kategorija',
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'label' => 'Miestas',
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(array(
                        'max' => 255,
                    )),
                ],
                'label' => 'Aprašymas',
            ])
            ->add('trainingTime', CollectionType::class, [
                'entry_type' => TrainingTimeType::class,
                'allow_add' => true,
                'prototype' => true,
                'required' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'delete_empty' => true,
                'constraints' => [
                  new NotBlank(),
                ],
                'label' => false,
            ])
            ->add('Sukurti', SubmitType::class, [
                'attr' => [
                    'class' => 'form-control btn btn-login',
                    'label' => 'Sukurti',
                ],

            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
