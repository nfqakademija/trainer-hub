<?php

namespace AppBundle\DataFixtures\Random;

class RandomFeedbackGenerator
{

    public static function generate()
    {
        $feedbacks = ['Blogas treneris, daugiau nesinaudosiu jo paslaugomis', 'Nuobodžios treniruotės',
        'Galėtu būti ir geriau', 'Geras treneris', 'Puikus treneris! Treniruosios pas jį vėl'];

        return $feedbacks[array_rand($feedbacks)];
    }
}
