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
        $userClient = new User();
        $userClient->setUsername('klientas');
        $userClient->setPlainPassword('test');
        $userClient->setEmail('klientas@klientas.lt');
        $userClient->setEnabled(true);
        $userClient->setRoles(array('ROLE_CLIENT'));
        $userClient->setCity('Vilnius');
        $userClient->setName('Aurimas');
        $userClient->setPhone('869999999');
        $userClient->setDescription('Lorem Ipsum is simply dummy 
            text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry\'s standard dummy 
            text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a 
            type specimen book. It has survived not only 
            five centuries, but also the leap into 
            electronic typesetting, remaining 
            essentially unchanged. It was popularised 
            in the 1960s with the release of Letraset 
            sheets containing Lorem Ipsum passages/');
       // $userClient->setAvatar('658b645d80c5789389a771cd340ee798.png');

        $manager->persist($userClient);
        $manager->flush();


        $userTrainer = new User();
        $userTrainer->setUsername('treneris');
        $userTrainer->setPlainPassword('test');
        $userTrainer->setEmail('treneris@treneris.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Vilnius');
        $userTrainer->setName('Aurimas');
        $userTrainer->setPhone('869999999');
        $userTrainer->setDescription('Lorem Ipsum is simply dummy 
            text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry\'s standard dummy 
            text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a 
            type specimen book. It has survived not only 
            five centuries, but also the leap into 
            electronic typesetting, remaining 
            essentially unchanged. It was popularised 
            in the 1960s with the release of Letraset 
            sheets containing Lorem Ipsum passages/');
       // $userTrainer->setAvatar('658b645d80c5789389a771cd340ee798.png');
        $manager->persist($userTrainer);
        $manager->flush();

        $userTrainer = new User();
        $userTrainer->setUsername('treneris1');
        $userTrainer->setPlainPassword('test');
        $userTrainer->setEmail('treneris1@treneris1.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Vilnius');
        $userTrainer->setName('Marek');
        $userTrainer->setPhone('869999999');
        $userTrainer->setDescription('Lorem Ipsum is simply dummy 
            text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry\'s standard dummy 
            text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a 
            type specimen book. It has survived not only 
            five centuries, but also the leap into 
            electronic typesetting, remaining 
            essentially unchanged. It was popularised 
            in the 1960s with the release of Letraset 
            sheets containing Lorem Ipsum passages/');
       // $userTrainer->setAvatar('63e3264cd41e7e79e5e86dab50ac22d5.png');
        $manager->persist($userTrainer);
        $manager->flush();

        $userTrainer = new User();
        $userTrainer->setUsername('Kažkoks Treneris');
        $userTrainer->setPlainPassword('test');
        $userTrainer->setEmail('treneris2@treneris1.lt');
        $userTrainer->setEnabled(true);
        $userTrainer->setRoles(array('ROLE_TRAINER'));
        $userTrainer->setCity('Vilnius');
        $userTrainer->setName('Marek');
        $userTrainer->setPhone('869999999');
        $userTrainer->setDescription('Lorem Ipsum is simply dummy 
            text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry\'s standard dummy 
            text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a 
            type specimen book. It has survived not only 
            five centuries, but also the leap into 
            electronic typesetting, remaining 
            essentially unchanged. It was popularised 
            in the 1960s with the release of Letraset 
            sheets containing Lorem Ipsum passages/');
       // $userTrainer->setAvatar('63e3264cd41e7e79e5e86dab50ac22d5.png');

        $manager->persist($userTrainer);
        $manager->flush();
          /*  $citiesArray = array();
        if (($handle = fopen(__DIR__."/cities.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, null, ",")) !== false) {
                $citiesArray[] = $data[1];
                   // $manager->persist($city);
                //$manager->flush();
            }
            fclose($handle);
        }
           $faker = Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $userTrainer = new User();
            $userTrainer->setUsername($faker->userName);
            $userTrainer->setPlainPassword($faker->password);
            $userTrainer->setEmail($faker->email);
            $userTrainer->setEnabled(true);
            $randomKey = array_rand($citiesArray);
            $randomCity = $citiesArray[$randomKey];
            $userTrainer->setRoles(array('ROLE_TRAINER'));
            $userTrainer->setCity($randomCity);
            $userTrainer->setName($faker->name);
            $userTrainer->setSurname('Zavoronok');
            $userTrainer->setPhone('869999999');
            $userTrainer->setDescription('Lorem Ipsum is simply dummy 
            text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry\'s standard dummy 
            text ever since the 1500s, when an unknown printer 
            took a galley of type and scrambled it to make a 
            type specimen book. It has survived not only 
            five centuries, but also the leap into 
            electronic typesetting, remaining 
            essentially unchanged. It was popularised 
            in the 1960s with the release of Letraset 
            sheets containing Lorem Ipsum passages/');
            $manager->persist($userTrainer);
            $manager->flush();
        }
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository(User::class);
            $cities = $em->getRepository(City::class);
            $categories = $em->getRepository(Category::class);
        if (($handle = fopen(__DIR__."/cities.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, null, ",")) !== false) {
                $citiesArray[] = $data[1];
               // $manager->persist($city);
                //$manager->flush();
            }
            fclose($handle);
        }
            $cities1 = $cities->findAll();
            $users1 = $users->findAll();
            $categories1 = $categories->findAll();
        foreach ($cities1 as $city) {
            $citiesIds[] = $city->getId();
        }
        foreach ($users1 as $user) {
            $usersIds[] = $user->getId();
        }
        foreach ($categories1 as $category) {
            $categoriesIds[] = $category->getId();
        }


            $faker = Factory::create();
        for ($i = 0; $i < 200; $i++) {
            $training = new Training();
            $training->setTitle($faker->word);
            $training->setPrice($faker->biasedNumberBetween($min = 10, $max = 100, $function = 'sqrt'));
            $training->setDescription($faker->text);
            $training->setDate($faker->dateTime());
            $training->setFosUser($users->find(rand(min($usersIds), max($usersIds))));
            $training->setCategory($categories->find(rand(min($categoriesIds), max($categoriesIds))));
            $training->setCity($cities->find(rand(min($citiesIds), max($citiesIds))));
            $manager->persist($training);
            $manager->flush();
        }*/
    }
}
