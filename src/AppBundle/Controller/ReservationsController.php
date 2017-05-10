<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TrainingTime;
use AppBundle\Entity\Reservations;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TrainingController
 * @package AppBundle\Controller;
 */
class ReservationsController extends Controller
{
    /**
     * @Route("/reservation/{id}", name="reservation_training")
     * @param TrainingTime $trainingTime
     * @Security("has_role('ROLE_CLIENT')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function reservationAction(TrainingTime $trainingTime)
    {

        $em = $this->getDoctrine()->getManager();
        $resRepo = $em->getRepository(Reservations::class);
        $ifRegistered = $resRepo->findIfRegistered($this->getUser(), $trainingTime);
        if (!$ifRegistered) {
            $trainingTime->setNumber($trainingTime->getNumber()-1);
            $reservation = new Reservations();
            $reservation->setFosUser($this->getUser());
            $reservation->setTrainingTime($trainingTime);
            $em->persist($reservation);
            $em->persist($trainingTime);
            $em->flush();

            return $this->redirectToRoute('training_page', ['id' => $trainingTime->getTraining()->getId()]);
        } else {
            return $this->render('@App/trainer/error.html.twig');
        }
    }

    /**
     * @Route("/remove/reservation/{id}", name="remove_reservation")
     * @param Reservations $reservation
     * @Security("has_role('ROLE_CLIENT')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|NotFoundHttpException
     */
    public function removeReservationAction(Reservations $reservation, Request $request)
    {
        $user = $reservation->getFosUser();
        if ($this->getUser() == $user) {
            $em = $this->getDoctrine()->getManager();
            $trainingTimeRepo = $em->getRepository(TrainingTime::class);
            $trainingTime = $reservation->getTrainingTime();
            $trainingTime->setNumber($trainingTime->getNumber()+1);
            $trainingTime->removeReservation($reservation);
            $em->remove($reservation);
            $em->persist($trainingTime);
            $em->flush();

            return $this->redirect($request->headers->get('referer'));
        } else {
            throw $this->createNotFoundException();
        }
    }

    /**
     * @Route("/my-reservations", name="my_reservations")
     * @Security("has_role('ROLE_CLIENT')")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function displayReservationsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $trainingTimeRepo = $em->getRepository(Reservations::class);
        $reservations = $trainingTimeRepo->findReservationsByUser($this->getUser());

        return $this->render('@App/clientReservations.html.twig', [
            'reservations' => $reservations,
        ]);
    }
}
