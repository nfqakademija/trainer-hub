<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Reservations;
use AppBundle\Entity\Training;
use AppBundle\Entity\User;
use AppBundle\Entity\Feedback;
use AppBundle\Form\Type\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class TrainerController
 * @package AppBundle\Controller
 */
class TrainerController extends Controller
{
    /**
     * @Route("/trainer/{username}", name="trainer_page")
     * @ParamConverter("user", class="AppBundle:User",  options={"repository_method" = "findWithTrainings"})
     * @param Request $request
     * @param User    $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function trainerAction(Request $request, User $user = null)
    {
        if ($user == null) {
            return $this->redirectToRoute('homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $feedbacks = $em->getRepository(Feedback::class);
        $feedbacks = $feedbacks->findFeedbackByTrainer($user);
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $currentUser = $this->getUser();
            $feedback->setFosUserAuthor($currentUser);
            $feedback->setFosUserObject($user);
            $em->persist($feedback);
            $em->flush();

            return $this->redirectToRoute('trainer_page', [
                'username' => $user->getUsernameCanonical(),
            ]);
        }

        return $this->render('@App/trainer/trainerPage.html.twig', [
            'trainers' => $user, 'feedback' => $form->createView(),
            'feedbacks' => $feedbacks,
        ]);
    }

    /**
     * @Route("/reservations", name="trainer_reservations")
     * @Security("has_role('ROLE_TRAINER')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function displayReservationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trainingTimeRepo = $em->getRepository(Reservations::class);
        $reservations = $trainingTimeRepo->findReservationsByTrainer($this->getUser());

        return $this->render('@App/trainer/trainerReservations.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    /**
     * @Route("/confirm/{id}", name="confirm_reservation")
     * @Security("has_role('ROLE_TRAINER')")
     * @param Reservations $reservation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function confirmReservationAction(Reservations $reservation)
    {
        $trainingTime = $reservation->getTrainingTime();
        $user = $trainingTime->getTraining()->getFosUser();
        if ($user == $this->getUser()) {
            $em = $this->getDoctrine()->getManager();
            //$training = $em->getRepository(Reservations::class)->findAll();
            $reservation->setStatus(1);
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('trainer_reservations');
        } else {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @Route("/cancel/{id}", name="cancel_reservation")
     * @Security("has_role('ROLE_TRAINER')")
     * @param Reservations $reservation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function cancelReservationAction(Reservations $reservation)
    {
        $trainingTime = $reservation->getTrainingTime();
        $user = $trainingTime->getTraining()->getFosUser();
        if ($user == $this->getUser()) {
            $em = $this->getDoctrine()->getManager();
            //$training = $em->getRepository(Reservations::class)->findAll();
            $reservation->setStatus(2);
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('trainer_reservations');
        } else {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @Route("/restore/{id}", name="restore_reservation")
     * @Security("has_role('ROLE_TRAINER')")
     * @param Reservations $reservation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function restoreReservationAction(Reservations $reservation)
    {
        $trainingTime = $reservation->getTrainingTime();
        $user = $trainingTime->getTraining()->getFosUser();
        if ($user == $this->getUser()) {
            $em = $this->getDoctrine()->getManager();
            //$training = $em->getRepository(Reservations::class)->findAll();
            $reservation->setStatus(0);
            $em->persist($reservation);
            $em->flush();

            return $this->redirectToRoute('trainer_reservations');
        } else {
            throw $this->createNotFoundException();
        }
    }
}
