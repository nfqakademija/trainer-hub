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
    public function trainerAction(Request $request, User $user)
    {
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
}
