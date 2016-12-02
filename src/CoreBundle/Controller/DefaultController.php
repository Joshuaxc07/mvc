<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bridge\Twig\Command;
class DefaultController extends Controller
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        if(!is_null($this->getUser()))
        {
            $user = $this->getUser();
            if(strcasecmp($user->getRole(), 'admin') == 0 || strcasecmp($user->getRole(), 'employee') == 0)
            {
                return $this->redirect($this->generateUrl('admin'));
            }
        }

        if ($session->isStarted()) {
            // get the login error if there is one
            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
            } else {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);

            }

            return $this->render('CoreBundle:Default:index.html.twig', array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error,
            ));
        } else {

            return $this->redirect($this->generateUrl('admin'));
        }
   session_destroy();
    }

    public function loginCheckAction()
    {

    }

    public function forbiddenAction()
    {
        throw new AccessDeniedHttpException();
    }
}


