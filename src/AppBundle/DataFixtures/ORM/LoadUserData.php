<?php


namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;
use AppBundle\Entity\City;
use AppBundle\Entity\Category;
use AppBundle\Entity\Training;
use Faker\Factory;

/**
 * Class LoadCities
 * @package AppBundle\DataFixtures\ORM
 */
class LoadUserData implements FixtureInterface
{
    /**

     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userTrainer = new User();
        $userTrainer->setUsername('Paulius');
        $userTrainer->setPlainPassword('paulius');
        $userTrainer->setEmail('paulius@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Vilnius');
        $userTrainer->setName('Paulius');
        $userTrainer->setPhone('869999999');
        $userTrainer->setAvatarName('590f3bf06714b.jpg');
        $userTrainer->setDescription('
        Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!
        ');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Tomas');
        $userTrainer->setPlainPassword('tomas');
        $userTrainer->setEmail('tomas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Kaunas');
        $userTrainer->setName('Tomas');
        $userTrainer->setPhone('869994719');
        $userTrainer->setAvatarName('590f3c73d4e62.jpeg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Simonas');
        $userTrainer->setPlainPassword('simonas');
        $userTrainer->setEmail('simonas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Radviliškis');
        $userTrainer->setName('Simonas');
        $userTrainer->setPhone('869999777');
        $userTrainer->setAvatarName('590f3c316733e.jpg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Danielius');
        $userTrainer->setPlainPassword('danielius');
        $userTrainer->setEmail('danielius@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Jonava');
        $userTrainer->setName('Danielius');
        $userTrainer->setPhone('861479777');
        $userTrainer->setAvatarName('590f3955418dd.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Lukas');
        $userTrainer->setPlainPassword('lukas');
        $userTrainer->setEmail('lukas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Klaipėda');
        $userTrainer->setName('Lukas');
        $userTrainer->setPhone('864498777');
        $userTrainer->setAvatarName('59103b5711dc5.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Danas');
        $userTrainer->setPlainPassword('danas');
        $userTrainer->setEmail('danas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Klaipėda');
        $userTrainer->setName('Danas');
        $userTrainer->setPhone('868799777');
        $userTrainer->setAvatarName('59103b7379cde.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Donatas');
        $userTrainer->setPlainPassword('donatas');
        $userTrainer->setEmail('donatas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Kretinga');
        $userTrainer->setName('Donatas');
        $userTrainer->setPhone('869412355');
        $userTrainer->setAvatarName('59103be9a4811.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Deividas');
        $userTrainer->setPlainPassword('deividas');
        $userTrainer->setEmail('deividas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Kaunas');
        $userTrainer->setName('Deividas');
        $userTrainer->setPhone('869911177');
        $userTrainer->setAvatarName('59103c0e3e750.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Elvinas');
        $userTrainer->setPlainPassword('elvinas');
        $userTrainer->setEmail('elvinas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Palanga');
        $userTrainer->setName('Elvinas');
        $userTrainer->setPhone('869333777');
        $userTrainer->setAvatarName('59103c5bbf887.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Marius');
        $userTrainer->setPlainPassword('marius');
        $userTrainer->setEmail('marius@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Kaunas');
        $userTrainer->setName('Marius');
        $userTrainer->setPhone('868559777');
        $userTrainer->setAvatarName('59103c732136c.jpg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Rokas');
        $userTrainer->setPlainPassword('rokas');
        $userTrainer->setEmail('rokas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Klaipėda');
        $userTrainer->setName('Rokas');
        $userTrainer->setPhone('864449777');
        $userTrainer->setAvatarName('59103c732136c.jpg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Ervinas');
        $userTrainer->setPlainPassword('ervinas');
        $userTrainer->setEmail('ervinas@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Palanga');
        $userTrainer->setName('Ervinas');
        $userTrainer->setPhone('868741777');
        $userTrainer->setAvatarName('59103b5711dc5.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Marek');
        $userTrainer->setPlainPassword('marek');
        $userTrainer->setEmail('marek@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Vilnius');
        $userTrainer->setName('Marek');
        $userTrainer->setPhone('8687747477');
        $userTrainer->setAvatarName('590f3bf06714b.jpg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Viktoras');
        $userTrainer->setPlainPassword('viktoras');
        $userTrainer->setEmail('viktoras@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Kaunas');
        $userTrainer->setName('Viktoras');
        $userTrainer->setPhone('868514777');
        $userTrainer->setAvatarName('590f3c73d4e62.jpeg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Dainius');
        $userTrainer->setPlainPassword('dainius');
        $userTrainer->setEmail('dainius@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Gargždai');
        $userTrainer->setName('Dainius');
        $userTrainer->setPhone('868741777');
        $userTrainer->setAvatarName('590f3c316733e.jpg');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('Vilius');
        $userTrainer->setPlainPassword('vilius');
        $userTrainer->setEmail('vilius@trainerhub.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Šiauliai');
        $userTrainer->setName('Vilius');
        $userTrainer->setPhone('868558414');
        $userTrainer->setAvatarName('590f3955418dd.png');
        $userTrainer->setDescription('Treneris, išmėginęs ne vieną sporto šaką visu 
        varžybiniu pajėgumu, universalumas – stiprioji jo pusė.
        Paulius veda funkcines, ištvermės ir bėgimo treniruotes.
        Turite viziją, bet nežinote nuo ko pradėti? Treneris yra 
        pasiruošęs siekti to, apie ką jau seniai svajojate!');

        $manager->persist($userTrainer);
        $manager->flush();
    }
}
