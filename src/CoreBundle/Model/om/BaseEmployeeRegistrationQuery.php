<?php

namespace CoreBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use CoreBundle\Model\EmployeeRegistration;
use CoreBundle\Model\EmployeeRegistrationPeer;
use CoreBundle\Model\EmployeeRegistrationQuery;

/**
 * @method EmployeeRegistrationQuery orderByEmpId($order = Criteria::ASC) Order by the emp_id column
 * @method EmployeeRegistrationQuery orderByEmpFname($order = Criteria::ASC) Order by the emp_fname column
 * @method EmployeeRegistrationQuery orderByEmpLname($order = Criteria::ASC) Order by the emp_lname column
 * @method EmployeeRegistrationQuery orderByEmpUsername($order = Criteria::ASC) Order by the emp_username column
 * @method EmployeeRegistrationQuery orderByEmpPassword($order = Criteria::ASC) Order by the emp_password column
 * @method EmployeeRegistrationQuery orderByRole($order = Criteria::ASC) Order by the role column
 *
 * @method EmployeeRegistrationQuery groupByEmpId() Group by the emp_id column
 * @method EmployeeRegistrationQuery groupByEmpFname() Group by the emp_fname column
 * @method EmployeeRegistrationQuery groupByEmpLname() Group by the emp_lname column
 * @method EmployeeRegistrationQuery groupByEmpUsername() Group by the emp_username column
 * @method EmployeeRegistrationQuery groupByEmpPassword() Group by the emp_password column
 * @method EmployeeRegistrationQuery groupByRole() Group by the role column
 *
 * @method EmployeeRegistrationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method EmployeeRegistrationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method EmployeeRegistrationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method EmployeeRegistration findOne(PropelPDO $con = null) Return the first EmployeeRegistration matching the query
 * @method EmployeeRegistration findOneOrCreate(PropelPDO $con = null) Return the first EmployeeRegistration matching the query, or a new EmployeeRegistration object populated from the query conditions when no match is found
 *
 * @method EmployeeRegistration findOneByEmpFname(string $emp_fname) Return the first EmployeeRegistration filtered by the emp_fname column
 * @method EmployeeRegistration findOneByEmpLname(string $emp_lname) Return the first EmployeeRegistration filtered by the emp_lname column
 * @method EmployeeRegistration findOneByEmpUsername(string $emp_username) Return the first EmployeeRegistration filtered by the emp_username column
 * @method EmployeeRegistration findOneByEmpPassword(string $emp_password) Return the first EmployeeRegistration filtered by the emp_password column
 * @method EmployeeRegistration findOneByRole(string $role) Return the first EmployeeRegistration filtered by the role column
 *
 * @method array findByEmpId(int $emp_id) Return EmployeeRegistration objects filtered by the emp_id column
 * @method array findByEmpFname(string $emp_fname) Return EmployeeRegistration objects filtered by the emp_fname column
 * @method array findByEmpLname(string $emp_lname) Return EmployeeRegistration objects filtered by the emp_lname column
 * @method array findByEmpUsername(string $emp_username) Return EmployeeRegistration objects filtered by the emp_username column
 * @method array findByEmpPassword(string $emp_password) Return EmployeeRegistration objects filtered by the emp_password column
 * @method array findByRole(string $role) Return EmployeeRegistration objects filtered by the role column
 */
abstract class BaseEmployeeRegistrationQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseEmployeeRegistrationQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'CoreBundle\\Model\\EmployeeRegistration';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new EmployeeRegistrationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   EmployeeRegistrationQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return EmployeeRegistrationQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof EmployeeRegistrationQuery) {
            return $criteria;
        }
        $query = new EmployeeRegistrationQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   EmployeeRegistration|EmployeeRegistration[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EmployeeRegistrationPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(EmployeeRegistrationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 EmployeeRegistration A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByEmpId($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 EmployeeRegistration A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `emp_id`, `emp_fname`, `emp_lname`, `emp_username`, `emp_password`, `role` FROM `employee_registration` WHERE `emp_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new EmployeeRegistration();
            $obj->hydrate($row);
            EmployeeRegistrationPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return EmployeeRegistration|EmployeeRegistration[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|EmployeeRegistration[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the emp_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpId(1234); // WHERE emp_id = 1234
     * $query->filterByEmpId(array(12, 34)); // WHERE emp_id IN (12, 34)
     * $query->filterByEmpId(array('min' => 12)); // WHERE emp_id >= 12
     * $query->filterByEmpId(array('max' => 12)); // WHERE emp_id <= 12
     * </code>
     *
     * @param     mixed $empId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByEmpId($empId = null, $comparison = null)
    {
        if (is_array($empId)) {
            $useMinMax = false;
            if (isset($empId['min'])) {
                $this->addUsingAlias(EmployeeRegistrationPeer::EMP_ID, $empId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($empId['max'])) {
                $this->addUsingAlias(EmployeeRegistrationPeer::EMP_ID, $empId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_ID, $empId, $comparison);
    }

    /**
     * Filter the query on the emp_fname column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpFname('fooValue');   // WHERE emp_fname = 'fooValue'
     * $query->filterByEmpFname('%fooValue%'); // WHERE emp_fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $empFname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByEmpFname($empFname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empFname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $empFname)) {
                $empFname = str_replace('*', '%', $empFname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_FNAME, $empFname, $comparison);
    }

    /**
     * Filter the query on the emp_lname column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpLname('fooValue');   // WHERE emp_lname = 'fooValue'
     * $query->filterByEmpLname('%fooValue%'); // WHERE emp_lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $empLname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByEmpLname($empLname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empLname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $empLname)) {
                $empLname = str_replace('*', '%', $empLname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_LNAME, $empLname, $comparison);
    }

    /**
     * Filter the query on the emp_username column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpUsername('fooValue');   // WHERE emp_username = 'fooValue'
     * $query->filterByEmpUsername('%fooValue%'); // WHERE emp_username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $empUsername The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByEmpUsername($empUsername = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empUsername)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $empUsername)) {
                $empUsername = str_replace('*', '%', $empUsername);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_USERNAME, $empUsername, $comparison);
    }

    /**
     * Filter the query on the emp_password column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpPassword('fooValue');   // WHERE emp_password = 'fooValue'
     * $query->filterByEmpPassword('%fooValue%'); // WHERE emp_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $empPassword The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByEmpPassword($empPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empPassword)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $empPassword)) {
                $empPassword = str_replace('*', '%', $empPassword);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmployeeRegistrationPeer::EMP_PASSWORD, $empPassword, $comparison);
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%'); // WHERE role LIKE '%fooValue%'
     * </code>
     *
     * @param     string $role The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function filterByRole($role = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $role)) {
                $role = str_replace('*', '%', $role);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EmployeeRegistrationPeer::ROLE, $role, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   EmployeeRegistration $employeeRegistration Object to remove from the list of results
     *
     * @return EmployeeRegistrationQuery The current query, for fluid interface
     */
    public function prune($employeeRegistration = null)
    {
        if ($employeeRegistration) {
            $this->addUsingAlias(EmployeeRegistrationPeer::EMP_ID, $employeeRegistration->getEmpId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
