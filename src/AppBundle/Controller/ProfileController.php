<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ProfileType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
    * @param Request $request
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        //$formFactory = $this->get('fos_user.profile.form.factory');

        $form = $this->createForm(ProfileType::class, $user, ['role' => $user->getRoles()]);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            $imagine = $this->get('liip_imagine.controller');
            $imagemanagerResponse = $imagine->filterAction(
                $request,         // http request
                'uploads/avatars/'.$user->getAvatarName(),      // original image you want to apply a filter to
                'my_heighten_filter'              // filter defined in config.yml
            );
            $imagemanagerResponse = $imagine->filterAction(
                $request,         // http request
                'uploads/avatars/'.$user->getAvatarName(),      // original image you want to apply a filter to
                'my_thumbnail_filter'              // filter defined in config.yml
            );
            $cacheManager = $this->get('liip_imagine.cache.manager');

            /** @var string */
            $sourcePath = $cacheManager->getBrowserPath(
                'uploads/avatars/'.$user->getAvatarName(),
                'my_heighten_filter'
            );
            $sourcePath = $cacheManager->getBrowserPath(
                'uploads/avatars/'.$user->getAvatarName(),
                'my_thumbnail_filter'
            );
            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(
                FOSUserEvents::PROFILE_EDIT_COMPLETED,
                new FilterUserResponseEvent($user, $request, $response)
            );

            return $this->redirectToRoute('homepage');
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
