<?php

namespace CoreBundle\AuthenticationHandler;

use CoreBundle\Model\EmpAcc;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints\DateTime;

class LoginHandler implements AuthenticationSuccessHandlerInterface
{
	protected $router;
    protected $security;
    
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token){

    	$response = new RedirectResponse($this->router->generate('error403'));

        $session    = new Session();

        if ($token->getUser() instanceof EmpAcc){


                $refererUrl = $this->router->generate('admin');
                $response = new RedirectResponse($refererUrl);
        }else{
            $response = array("Account Inactive");
            echo json_encode($response);
            exit;
        }


        return $response;
    }
    	// if (isset($token)) {
    	// 	if (($request->request->get('_username') === 'superadmin' && $request->request->get('_password') === 'sominc123')) {
    	// 		$refererUrl = $request->getSession()->get('_security.secured_area.target_path');
                
     //            if ($refererUrl != null) {
     //                $refererUrl = $this->router->generate('admin_homepage');
     //            }
                
    	// 	} else {
     //            echo $request->request->get('_username');

     //        	$refererUrl = $request->getSession()->get('_security.secured_area.target_path');
     //            $user = $token->getUser();

     //        	if ($token->getUser() instanceof EmpAcc) {

     //                // $level = $user->getRole();
     //                // if(strcasecmp($level, 'admin') == 0){
     //                    $refererUrl = $this->router->generate('admin_homepage');    
     //                // }else if (strcasecmp($level, 'employee') == 0){
     //                //     $refererUrl = $this->router->generate('main_homepage');                            
     //                // }
     //        	}
     //        }
     //        $response = new RedirectResponse($refererUrl);
    	// }

        // return $response;
    // }
}

?>