<?php

namespace CoreBundle\AuthenticationHandler;

use CoreBundle\Model\EmployeeRegistration;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;



class LogoutHandler implements LogoutSuccessHandlerInterface
{
	protected $router;
    private $security;
    
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onLogoutSuccess(Request $request)
    {
    	if ($this->security->getToken()->getUser()->getEmpPassword() != 'f3b79a6e26ffd1bdf55079739d169e37f06c9bdbbc10e0a09e89a1113963873a03f962a0bdeec23e56461780631f011b466ab1882d3e5330846c7f19442cfdc6') {
    		if ($this->security->getToken()->getUser() instanceof EmployeeRegistration) {

    		}
    	}

    	// redirect the user to where they were before the login process begun.
        $referer_url = $request->headers->get('/');
        
        if ($referer_url != null) {
            $response = new RedirectResponse($referer_url);

        } else {
            $response = new RedirectResponse('/');
        }       
        return $response;
    }
}

?>