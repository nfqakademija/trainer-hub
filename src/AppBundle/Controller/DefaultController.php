<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Training;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Form\Type\FilterType;

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
        $trainingsRepo = $em->getRepository(Training::class);
        $cities = $trainingsRepo->findCities();
        $categories = $trainingsRepo->findCategories();
        foreach ($categories as $category) {
            $categoriesNew[] = $category['title'];
        }
        foreach ($cities as $city) {
            $citiesNew[] = $city['title'];
        }

        if (!empty($_GET['categories']) && !empty($_GET['cities'])) {
            $trainers = $trainersRepo->filterBoth($_GET['categories'], $_GET['cities']);
        } elseif (empty($_GET['categories']) && !empty($_GET['cities'])) {
            $trainers = $trainersRepo->filterByCity($_GET['cities']);
        } elseif (!empty($_GET['categories']) && empty($_GET['cities'])) {
            $trainers = $trainersRepo->filterByCategory($_GET['categories']);
        } else {
            $trainers = $trainersRepo->findByRoles('ROLE_TRAINER');
        }
        $paginator = $this->get('knp_paginator');
        $trainers = $paginator->paginate(
            $trainers, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return $this->render('@App/public/index.html.twig', [
            'trainers' => $trainers,
            'cities' => array_unique($citiesNew),
            'categories' => array_unique($categoriesNew),
            'currentCity' => isset($_GET['cities'])?$_GET['cities']:'all',
            'currentCategory' => isset($_GET['categories'])?$_GET['categories']:'all',
        ]);
    }
}