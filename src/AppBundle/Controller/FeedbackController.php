<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feedback;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FeedbackController extends Controller
{
    /**
     * @Route("/my-feedbacks", name="my_feedbacks")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository(Feedback::class);
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_CLIENT')) {
            $feedback = $repo->findFeedbackByTrainer($this->getUser());
        }
        if (false === $this->get('security.authorization_checker')->isGranted('ROLE_TRAINER')) {
            $feedback = $repo->findFeedbackByClient($this->getUser());
        }

        return $this->render('@App/trainer/profileFeedbacks.html.twig', [
            'feedbacks' => $feedback,
        ]);
    }
}
