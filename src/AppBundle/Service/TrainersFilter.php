<?php

namespace AppBundle\Service;

/**
* Filter trainers
*/
class TrainersFilter
{

    private $trainersRepo;

    /**
    * Trainers repository
    * @param \AppBundle\Repository\UserRepository $repo
    */
    public function __construct(\AppBundle\Repository\UserRepository $repo)
    {
        $this->trainersRepo = $repo;
    }
    /**
    * Filter trainers by city and category
    * @return array $trainers
    */
    public function filter():array
    {
        if (!empty($_GET['categories']) && !empty($_GET['cities'])) {
            $trainers = $this->trainersRepo->filterBoth(
                $_GET['categories'],
                $_GET['cities']
            );

            return $trainers;
        } elseif (empty($_GET['categories']) && !empty($_GET['cities'])) {
            $trainers = $this->trainersRepo->filterByCity(
                $_GET['cities']
            );

            return $trainers;
        } elseif (!empty($_GET['categories']) && empty($_GET['cities'])) {
            $trainers = $this->trainersRepo->filterByCategory(
                $_GET['categories']
            );

            return $trainers;
        } else {
            $trainers = $this->trainersRepo->findByRolesWithFeedbacks('ROLE_TRAINER');

            return $trainers;
        }
    }
}
