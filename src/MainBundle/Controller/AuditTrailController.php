<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/1/2016
 * Time: 1:04 PM
 */

namespace MainBundle\Controller;

date_default_timezone_set('Asia/Manila');

use CoreBundle\Model\auditTrail;
use CoreBundle\Model\auditTrailPeer;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Session\Session;

class AuditTrailController extends Controller
{

    public function indexAction()
    {
        return $this->render('MainBundle:Default:audit.html.twig');
    }
    public function timeinAction()
    {
        $request = $this->getRequest();
        if ($request->getMethod() == "POST") 
        {

                $d = new \DateTime();
            $d = $d->format("y-m-d");
            $params = $request->request->all();
            $time_in = $params["time_in"];
            $employee_audit = new auditTrail();
            $employee_audit->setTimeIn($time_in);
            $employee_audit->setDate($d);
            $employee_audit->save();
            return new JsonResponse($employee_audit);
        }
        $response = new Response();
        $response->setStatusCode(200);

        return $this->redirect("MainBundle:Default:time_out.html.twig");

    }
    public function timeoutAction($id)
    {
//        $employee_audit = new auditTrail();
//        $request = $this->getRequest();
//        if($request->getMethod() == "POST")
//        {
//            $params = $request->request->all();
//            $employee_audit  = new auditTrail();
//            $date = datetime();
//            $new_datetime= strtotime("Y-M-D", $date);
//            $employee_audit->setTimeOut();
//
//
//        }
//        $employee_audit->setTimeOut();
//        return $this->render('MainBundle:Default:time_out.html.twig');
        $datatime = auditTrailPeer::retrieveByPK($id);
        $timename = '';
        $request = $this->getRequest();
        $datetimetoday = new \DateTime();
        $datetimetoday 	= $datetimetoday->format('y-m-d');
        if($request->getMethod() == "POST")
        {
            $params = $request->request->all();
            $employee = auditTrailPeer::getLastTimeIn();
            $employee->setTimeOut($datetimetoday);
            $employee->save();
            return new JsonResponse($employee);

        }
        echo $datetimetoday;
            return $this->render("MainBundle:Default:time_out.html.twig");

    }


}