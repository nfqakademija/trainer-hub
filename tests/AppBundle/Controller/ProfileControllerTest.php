<?php
namespace Tests\AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\AppBundle\App\Helper\LoginHelper;
use Tests\AppBundle\App\Helper\DbFixturesHelper;
use AppBundle\DataFixtures\ORM\LoadUserData;

class ProfileControllerTest extends WebTestCase
{

    public function testProfileEdit()
    {

        $client = static::createClient();
        DbFixturesHelper::loadFixtures( $client->getContainer(),
        	[new LoadUserData()]);
        LogInHelper::logInUser($client, 'paulius@trainerhub.lt');

        $response = $client->request('GET', '/profile/edit');

        $this->assertGreaterThan(
            0,
            $response->filter('html:contains("Profilio redagavimas")')->count()
        );
    }

}
