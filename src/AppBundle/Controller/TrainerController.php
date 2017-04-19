<?php
namespace AppBundle\Controller;


use AppBundle\Entity\Reservations;
use AppBundle\Entity\Training;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class TrainerController extends Controller
{
    /**
     * @Route("/trainer/{id}", name="trainer_page")
     */
    public function trainerAction(Request $request, $id)
    {
        $trainers = $this->getDoctrine()
            ->getRepository(User::class)->findWithTrainings($id);
        return $this->render('@App/trainer/trainerPage.html.twig', [
            'trainers' => $trainers[0]
        ]);
    }

    /**
     * @Route("/trainer/reservate/{id}", name="reservation")
     */
    public function reservationAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $training = $em->getRepository(Training::class)->find($id);

        $reservation = new Reservations();
        $user = $this->getUser();
        $reservation->setFosUser($user);
        $reservation->setTraining($training);
        $reservation->setDate(new \DateTime('now'));

        $em->persist($reservation);
        $em->flush();

        return $this->redirectToRoute('homepage');

    }

}