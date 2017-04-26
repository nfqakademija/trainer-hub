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

        $em = $this->getDoctrine()->getManager();

        $trainers = $em->getRepository(User::class);

        $trainers = $trainers->findByRoles('ROLE_TRAINER');

        $paginator  = $this->get('knp_paginator');
        $trainers = $paginator->paginate(
            $trainers, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return $this->render('@App/public/index.html.twig', [
            'trainers' => $trainers
        ]);
    }
}
