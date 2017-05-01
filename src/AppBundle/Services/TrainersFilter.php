<?php

namespace AppBundle\Services;

class TrainersFilter
{

    private $trainersRepo;

    public function __construct(\AppBundle\Repository\UserRepository $repo)
    {
        $this->trainersRepo = $repo;
    }

    public function filter()
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
