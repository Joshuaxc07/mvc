<?php

namespace MainBundle\Controller;

use CoreBundle\Model\EmpAcc;
use CoreBundle\Model\EmployeeRegistration;
use CoreBundle\Model\prols_emp_acc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MainBundle:Default:index.html.twig', array('name' => $name));
    }
    public function registerAction()
    {
        $request = $this->getRequest();
        if($request ->getMethod() == "POST")
        {
            $params = $request->request->all();

            $user_name = $params["username"];
            $password= $params["password"];
            $employee_info = new EmpAcc();

            $employee_info->setUsername($user_name);
            $employee_info->setPassword($password);

            $employee_info->save();
            return new JsonResponse($employee_info);

        }
        return $this->render('MainBundle:Default:registration.html.twig');
    }
}
