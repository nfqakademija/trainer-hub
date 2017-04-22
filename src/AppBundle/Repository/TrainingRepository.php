<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * TrainingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TrainingRepository extends EntityRepository
{
    public function findByUser($user)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.category', 'ca')
            ->addSelect('ca')
            ->leftJoin('t.city', 'ci')
            ->addSelect('ci')
            ->where('t.fos_user = :user')
            ->setParameter(':user', $user)->getQuery()->getArrayResult();
    }

}
