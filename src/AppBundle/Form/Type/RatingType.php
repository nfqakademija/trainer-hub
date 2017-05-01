<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
* Generate stars values for feedback form
*/
class RatingType extends AbstractType
{
    /**
    * @param OptionsResolver $resolver
    * Options for feedback form
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                '1' => 1,
                '2' => 2,
                '3' => 3,
                '4' => 4,
                '5' => 5,
            ),
        ));
    }
    /**
     * get parent Choice type
     * @return class
    */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
