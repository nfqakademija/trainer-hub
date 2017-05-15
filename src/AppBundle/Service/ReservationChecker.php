<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Repository\ReservationsRepository;

/**
 * Class ReservationChecker
 * @package AppBundle\Services
 */
class ReservationChecker
{

    private $repo;

    /**
     * ReservationChecker constructor.
     * @param ReservationsRepository $repo
     */
    public function __construct(ReservationsRepository $repo)
    {

        $this->repo = $repo;
    }

    /**
     * @param User $user
     * @param $trainingTime
     * @return mixed
     */
    public function isRegistered(User $user, $trainingTime)
    {
        foreach ($trainingTime->getTrainingTime() as $training) {
            $oldTraining = $training;
            $result = $this->repo->findIfRegistered($user, $training);
            if ($result) {
                $training->is_registered = true;
                $training->reservation = $result->getId();
            }
            $trainingTime->removeTrainingTime($oldTraining);
            $trainingTime->addTrainingTime($training);
        }

            return $trainingTime;
    }
}
