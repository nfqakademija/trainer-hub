<?php

namespace AppBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\Mapping\Entity;
use AppBundle\Entity\Feedback;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('feedback', TextareaType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(array(
                        'max' => 255
                    )),
                ],
                'label' => 'Palikite atsiliepimą'
            ]);
    }
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