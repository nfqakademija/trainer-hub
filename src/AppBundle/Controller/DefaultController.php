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
        $trainingsRepo = $em->getRepository(Training::class);     
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

        $trainersFinder = $this->get('filter');
        $trainers = $trainersFinder->filter();
        $ratingsFinderWithTrainers = $this->get('average');
        $trainersWithRatings = $ratingsFinderWithTrainers->average($trainers);

        $paginator = $this->get('knp_paginator');
       
        $trainersWithRatings = $paginator->paginate(
            $trainersWithRatings, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );
        return $this->render('@App/public/index.html.twig', [
            'trainers' => $trainersWithRatings,
            'cities' => !empty($citiesNew)?array_unique($citiesNew):'',
            'categories' => !empty($categoriesNew)?array_unique($categoriesNew):'',
            'currentCity' => isset($_GET['cities'])?$_GET['cities']:'all',
            'currentCategory' => isset($_GET['categories'])?$_GET['categories']:'all',
        ]);
    }
}