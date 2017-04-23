<?php
namespace AppBundle\Controller;


use AppBundle\Entity\Reservations;
use AppBundle\Entity\Training;
use AppBundle\Entity\User;
use AppBundle\Entity\Feedback;
use AppBundle\Form\Type\FeedbackType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TrainerController extends Controller
{
    /**
     * @Route("/trainer/{username}", name="trainer_page")
     * @ParamConverter("user", class="AppBundle:User",  options={"repository_method" = "findWithTrainings"})
     */
    public function trainerAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $feedbacks = $em->getRepository(Feedback::class);
        $feedbacks = $feedbacks->findFeedbackByUser($user);
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $current_user = $this->getUser();
            $feedback->setFosUserAuthor($current_user);
            $feedback->setFosUserObject($user);
            $em->persist($feedback);
            $em->flush();

            return $this->redirectToRoute('trainer_page', array('username' => $user->getUsernameCanonical()));
        }

        return $this->render('@App/trainer/trainerPage.html.twig', [
            'trainers' => $user, 'feedback' => $form->createView(),
            'feedbacks' => $feedbacks
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