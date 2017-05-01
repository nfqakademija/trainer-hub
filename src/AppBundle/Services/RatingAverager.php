<?php

namespace AppBundle\Services;

class RatingAverager {

	private $trainersRepo;

    public function __construct(\AppBundle\Repository\UserRepository $repo) {
        $this->trainersRepo = $repo;
    }

    public function average($trainers) {
    	foreach ($trainers as $trainer) {
    		$feedbacks = $trainer['feedback_to'];
    		if (isset($feedbacks) && !empty($feedbacks)) {
	    		foreach ($feedbacks as $feedback) {
	    			$ratingsArray[] = $feedback['rating'];
	    		}
	    		$trainer['rating'] = round((array_sum($ratingsArray) / count($ratingsArray)), 2);
	    		$ratingsArray = [];
    		}
    		$trainersNew[] = $trainer;
    	}
    	return $trainersNew;
    }
}