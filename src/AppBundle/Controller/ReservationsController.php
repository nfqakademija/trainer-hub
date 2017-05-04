<?php
namespace AppBundle\Controller;

use AppBundle\Entity\TrainingTime;
use AppBundle\Entity\Reservations;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        $trainingTimeRepo = $em->getRepository(TrainingTime::class);

        $training = $trainingTimeRepo->find($trainingTime);
        
        $training->setNumber($training->getNumber()-1);

        $reservation = new Reservations();

        $reservation->setFosUser($this->getUser());

        $reservation->setTrainingTime($training);

        $em->persist($reservation);

        $em->persist($training);

        $em->flush();


        return $this->redirectToRoute('homepage');
    }
}
