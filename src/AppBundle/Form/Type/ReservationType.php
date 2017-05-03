<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use AppBundle\Entity\Reservations;
use AppBundle\Entity\TrainingTime;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
* Generate new reservation form
*/
class ReservationType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array                $options
    * Build the form
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('training', HiddenType::class, [
                'data_class' => TrainingTime::class
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
