<?php

namespace AppBundle\Services;

/**
* Calculating rating average
*/
class RatingAverage
{
    /**
    * Average of trainers ratings
    * @param Trainers $trainers
    * @return array
    */
    public function average($trainers):array
    {
        foreach ($trainers as $trainer) {
            $feedbacks = isset($trainer['feedbackTo'])?$trainer['feedbackTo']:'';
            if (isset($feedbacks) && !empty($feedbacks)) {
                foreach ($feedbacks as $feedback) {
                    $ratingsArray[] = $feedback['rating'];
                }
                $trainer['rating'] = round((array_sum($ratingsArray) / count($ratingsArray)), 2);
                $ratingsArray = [];
            } else {
                $trainer['rating'] = 0;
            }
            $trainersNew[] = $trainer;
        }
        if (!empty($trainersNew)) {
            usort($trainersNew, function ($a, $b) {
                if (!isset($a['rating']) || !isset($b['rating'])) {
                    return 0;
                }
                return $b['rating'] <=> $a['rating'];
            });
            return $trainersNew;
        } else {
            return $trainers;
        }
    }
}
