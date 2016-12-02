<?php

namespace CoreBundle\Model;

use CoreBundle\Model\om\BaseauditTrailPeer;

class auditTrailPeer extends BaseauditTrailPeer
{
    public static function getLastTimeIn(\Criteria $c = null)
    {

        if (is_null($c))
        {
            $c = new \Criteria();
        }
        $d = new \DateTime();
        $d = date_format($d, 'Y-m-d');

        $c->add(self::DATE, $d , \Criteria::EQUAL)
            ->addDescendingOrderByColumn(self::TIME_IN);

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }

}
