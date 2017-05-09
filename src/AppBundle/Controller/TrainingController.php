<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Training;
use AppBundle\Entity\TrainingTime;
use AppBundle\Entity\Reservations;
use AppBundle\Form\Type\TrainingType;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Form\Type\ReservationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TrainingController
 * @package AppBundle\Controller;
 */
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
     * @param Request $request
     * @Security("has_role('ROLE_TRAINER')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository(Training::class)->find($id);

        if (!$training) {
            throw $this->createNotFoundException('No training found for id '.$id);
        }

        $originalTime = new ArrayCollection();

        foreach ($training->getTrainingTime() as $trainingTime) {
            $originalTime->add($trainingTime);
        }

        $editForm = $this->createForm(TrainingType::class, $training);

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($originalTime as $time) {
                if (false === $training->getTrainingTime()->contains($time)) {
                     $em->remove($time);
                }
            }

            $em->persist($training);
            $em->flush();

            return $this->redirectToRoute('homepage', array('id' => $id));
        }

        return $this->render('@App/trainer/newTraining.html.twig', [
            'trainingForm' => $editForm->createView(),
        ]);
    }

    /**
     * @Security("has_role('ROLE_TRAINER')")
     * @Route("/my-trainings", name="my_trainings")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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

    /**
     * @Route("/trainer/training/{id}", name="training_page")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
    public function displayTrainingAction(Training $training)
    {
        $em = $this->getDoctrine()->getManager();
        $trainingRepo = $em->getRepository(Training::class);
        $trainingsWithTimes = $trainingRepo->findWithTimes($training);
        $reservationsService = $this->get('app.is_registered');
        if (true === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $reservations = $reservationsService->isRegistered($this->getUser(), $trainingsWithTimes);

            return $this->render('@App/trainer/trainingPage.html.twig', [
                'training' => $reservations,
            ]);
        } else {
            return $this->render('@App/trainer/trainingPage.html.twig', [
                'training' => $trainingsWithTimes,
            ]);
        }
    }
}
