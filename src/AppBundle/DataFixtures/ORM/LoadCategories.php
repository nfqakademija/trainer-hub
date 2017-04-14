<?php
namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Class LoadCities
 * @package AppBundle\DataFixtures\ORM
 */
class LoadCategories implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . "/categories.csv", "r")) !== false) {
            while (($data = fgetcsv($handle, null, ",")) !== false) {
                $category = new Category();
                $category->setTitle($data[1]);
                $manager->persist($category);
                $manager->flush();
            }
            fclose($handle);
        }
    }
}
