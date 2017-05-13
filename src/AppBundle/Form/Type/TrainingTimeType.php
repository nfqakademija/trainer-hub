<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\TrainingTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Generate new trainingTime form
 */
class TrainingTimeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     * Build the form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', NumberType::class, [
                'label' => 'Vietų skaičius',
                'constraints' => [
                    new NotBlank(),
                    new Regex(
                        [
                            'pattern' => '/^[0-9]\d*$/',
                        ]
                    ),
                ],
            ])
            ->add('date', DateTimeType::class, [
                'label' => false,
                'years' => range(date('Y'), date('Y') + 5),
                'months' => range(date('m'), date('m')+11),
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TrainingTime::class,
        ]);
    }
}
