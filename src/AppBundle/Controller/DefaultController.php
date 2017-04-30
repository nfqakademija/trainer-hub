<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $trainersRepo = $em->getRepository(User::class);
        if ($request->get('city') != null && $request->get('city') != 'all') {
            $trainers = $trainersRepo->filterByCity($request->get('city'));
        } else {
            $trainers = $trainersRepo->findByRoles('ROLE_TRAINER');
        }
        $cities = $trainersRepo->findCities();
        foreach ($cities as $city) {
            $citiesNew[] = $city['city'];
        }
        $paginator = $this->get('knp_paginator');
        $trainers = $paginator->paginate(
            $trainers, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        if ($request->get('city') != null && $request->get('city') != 'all') {
            $content = $this->render('@App/public/filterAction.html.twig', array(
                'trainers' => $trainers,
                'cities' => array_unique($citiesNew),
                'currentCity' => $request->get('city')))->getContent();

            return new JsonResponse($content);
        } else {
            if ($request->get('city') == 'all') {
                $content = $this->render('@App/public/filterAction.html.twig', array(
                    'trainers' => $trainers,
                    'cities' => array_unique($citiesNew),
                    'currentCity' => $request->get('city')))->getContent();

                return new JsonResponse($content);
            } else {
                return $this->render('@App/public/index.html.twig', [
                    'trainers' => $trainers,
                    'cities' => array_unique($citiesNew),
                ]);
            }
        }
    }
}