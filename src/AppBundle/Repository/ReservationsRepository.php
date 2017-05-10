<?php

namespace AppBundle\Repository;

use AppBundle\Entity\TrainingTime;
use AppBundle\Entity\User;
use Doctrine\ORM\NoResultException;

/**
 * ReservationsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationsRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param User         $user
     * @param TrainingTime $trainingTime
     * @return bool|mixed
     */
    public function findIfRegistered(User $user, TrainingTime $trainingTime)
    {
        try {
            return $this->createQueryBuilder('r')
                ->where('r.fosUser = :user AND r.trainingTime = :training')
                ->setParameters(['user' => $user, 'training' => $trainingTime])
                ->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return false;
        }
    }

    /**
     * @param \AppBundle\Entity\User $user
     * @return array
     */
    public function findReservationsByUser(User $user)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.trainingTime', 't')
            ->addSelect('t')
            ->leftJoin('t.training', 'tr')
            ->addSelect('tr')
            ->where('r.fosUser = :user')
            ->setParameter(':user', $user)->getQuery()->getArrayResult();
    }

    /**
     * @param \AppBundle\Entity\User $user
     * @return array
     */
    public function findReservationsByTrainer(User $user)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.fosUser', 'b')
            ->addSelect('b')
            ->leftJoin('r.trainingTime', 't')
            ->addSelect('t')
            ->leftJoin('t.training', 'tr')
            ->addSelect('tr')
            ->where('tr.fosUser = :user')
            ->setParameter(':user', $user)->getQuery()->getArrayResult();
    }
}
