<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Training;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findByRolesWithFeedbacks($role)
    {

        return $this->createQueryBuilder('u')
            ->leftJoin('u.feedback_to', 'f')
            ->addSelect('f')
            ->where('u.roles LIKE :role')
            ->setParameter(':role', '%"'.$role.'"%')->getQuery()->getArrayResult();
    }

    public function findWithTrainings($user)
    {
        $username = $user['username'];

        return $this->createQueryBuilder('u')
            ->leftJoin('u.training', 't')
            ->addSelect('t')
            ->leftJoin('t.category', 'ca')
            ->addSelect('ca')
            ->leftJoin('t.city', 'ci')
            ->addSelect('ci')
            ->where('u.usernameCanonical = :username')
            ->setParameter(':username', $username)->getQuery()->getSingleResult();
    }
    public function filterBoth($category, $city) {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.training', 't')
            ->addSelect('t')
            ->leftJoin('t.category', 'ca')
            ->addSelect('ca')
            ->leftJoin('t.city', 'ci')
            ->addSelect('ci')
            ->where('ca.title = :category AND ci.title = :city')
            ->setParameters(['category' => $category, 'city' => $city])
            ->getQuery()->getArrayResult();
    }
    public function filterByCity($city) {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.training', 't')
            ->addSelect('t')
            ->leftJoin('t.category', 'ca')
            ->addSelect('ca')
            ->leftJoin('t.city', 'ci')
            ->addSelect('ci')
            ->where('ci.title = :city')
            ->setParameter(':city', $city)
            ->getQuery()->getArrayResult();
    }
    public function filterByCategory($category) {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.training', 't')
            ->addSelect('t')
            ->leftJoin('t.category', 'ca')
            ->addSelect('ca')
            ->leftJoin('t.city', 'ci')
            ->addSelect('ci')
            ->where('ca.title = :category')
            ->setParameter(':category', $category)
            ->getQuery()->getArrayResult();
    }
}
