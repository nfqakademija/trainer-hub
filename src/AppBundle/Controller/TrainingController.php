<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Training;
use AppBundle\Form\Type\TrainingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TrainingController extends Controller
{
    /**
     * @Route("/new-training", name="new_training")
     * @param Request $request
     * @Security("has_role('ROLE_TRAINER')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $user = $this->getUser();
            $training->setFosUser($user);

            $em->persist($training);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@App/trainer/newTraining.html.twig', [
            'trainingForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/edit/{id}", name="edit_training")
     * @param Training $training
     * @param Request  $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Training $training, Request $request)
    {
        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $user = $this->getUser();
            $training->setFosUser($user);

            $em->persist($training);
            $em->flush();

            return $this->redirectToRoute('my_trainings');
        }

        return $this->render('@App/trainer/newTraining.html.twig', [
            'trainingForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/my-trainings", name="my_trainings")
     **/
    public function displayAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('AppBundle:Training');
        $currentUser = $this->getUser();
        $trainings = $em->findByUser($currentUser);

        return $this->render('@App/trainer/profileTrainings.html.twig', [
            'trainings' => $trainings,
        ]);
    }
}
