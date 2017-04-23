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
        $feedbacks = $repo->findFeedbackByUser($this->getUser());
        return $this->render('@App/trainer/profileFeedbacks.html.twig', array('feedbacks' => $feedbacks));
    }
}
