<?php


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userClient = new User();
        $userClient->setUsername('klientas');
        $userClient->setPlainPassword('test');
        $userClient->setEmail('klientas@klientas.lt');
        $userClient->setEnabled(true);
        $userClient->setRoles(array('ROLE_CLIENT'));

        $manager->persist($userClient);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('treneris');
        $userTrainer->setPlainPassword('test');
        $userTrainer->setEmail('treneris@treneris.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));

        $manager->persist($userTrainer);
        $manager->flush();

        $userTrainer = new User();
        $userTrainer->setUsername('treneris1');
        $userTrainer->setPlainPassword('test');
        $userTrainer->setEmail('treneris1@treneris1.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));

        $manager->persist($userTrainer);
        $manager->flush();

        $userTrainer = new User();
        $userTrainer->setUsername('Kažkoks Treneris');
        $userTrainer->setPlainPassword('test');
        $userTrainer->setEmail('treneris2@treneris1.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));

        $manager->persist($userTrainer);
        $manager->flush();
    }
}