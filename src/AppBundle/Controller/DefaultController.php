<?php

namespace AppBundle\Controller;

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
        $trainings = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Training');
        $trainings = $trainings->findAll();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array('trainings' => $trainings));
    }
}
