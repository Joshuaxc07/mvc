<?php

namespace CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'employee_registration' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.CoreBundle.Model.map
 */
class EmployeeRegistrationTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.CoreBundle.Model.map.EmployeeRegistrationTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('employee_registration');
        $this->setPhpName('EmployeeRegistration');
        $this->setClassname('CoreBundle\\Model\\EmployeeRegistration');
        $this->setPackage('src.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('emp_id', 'EmpId', 'INTEGER', true, null, null);
        $this->addColumn('emp_fname', 'EmpFname', 'VARCHAR', true, 255, null);
        $this->addColumn('emp_lname', 'EmpLname', 'VARCHAR', true, 255, null);
        $this->addColumn('emp_username', 'EmpUsername', 'VARCHAR', true, 255, null);
        $this->addColumn('emp_password', 'EmpPassword', 'VARCHAR', true, 255, null);
        $this->addColumn('role', 'Role', 'VARCHAR', false, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

} // EmployeeRegistrationTableMap
