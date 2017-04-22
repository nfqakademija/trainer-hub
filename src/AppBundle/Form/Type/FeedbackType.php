<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 17.4.22
 * Time: 15.57
 */

namespace AppBundle\Form\Type;
use AppBundle\Entity\Feedback;

class FeedbackType extends AbstractType
{

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class
        ]);
    }
}