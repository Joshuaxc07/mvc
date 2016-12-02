<?php

namespace CoreBundle\Model;

use CoreBundle\Model\om\BaseEmployeeRegistrationQuery;

class EmployeeRegistrationQuery extends BaseEmployeeRegistrationQuery
{
    /**
     * @param null $select
     */
    public function setSelect($select)
    {
        $this->select = $select;
    }
    public /**
     * @return array
     */
    public function getNamedCriterions()
    {
        return $this->namedCriterions;
    }
}
