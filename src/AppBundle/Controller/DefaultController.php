<?php
namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $trainers = $this->get('doctrine.orm.default_entity_manager')->getRepository('AppBundle:User');
        $trainers = $trainers->findByRoles('ROLE_TRAINER');

        return $this->render('default/index.html.twig', array('trainers' => $trainers));

    }
}