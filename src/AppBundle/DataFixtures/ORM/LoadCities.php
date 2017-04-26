<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\City;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadCities
 * @package AppBundle\DataFixtures\ORM
 */
class LoadCities implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__."/cities.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, null, ",")) !== false) {
                $city = new City();
                $city->setTitle($data[1]);
                $manager->persist($city);
                $manager->flush();
            }
            fclose($handle);
        }
    }
}
