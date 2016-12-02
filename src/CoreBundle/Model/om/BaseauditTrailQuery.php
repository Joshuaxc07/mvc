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
use CoreBundle\Model\auditTrail;
use CoreBundle\Model\auditTrailPeer;
use CoreBundle\Model\auditTrailQuery;

/**
 * @method auditTrailQuery orderById($order = Criteria::ASC) Order by the id column
 * @method auditTrailQuery orderByTimeIn($order = Criteria::ASC) Order by the time_in column
 * @method auditTrailQuery orderByTimeOut($order = Criteria::ASC) Order by the time_out column
 * @method auditTrailQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method auditTrailQuery orderByLevel($order = Criteria::ASC) Order by the level column
 *
 * @method auditTrailQuery groupById() Group by the id column
 * @method auditTrailQuery groupByTimeIn() Group by the time_in column
 * @method auditTrailQuery groupByTimeOut() Group by the time_out column
 * @method auditTrailQuery groupByDate() Group by the date column
 * @method auditTrailQuery groupByLevel() Group by the level column
 *
 * @method auditTrailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method auditTrailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method auditTrailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method auditTrail findOne(PropelPDO $con = null) Return the first auditTrail matching the query
 * @method auditTrail findOneOrCreate(PropelPDO $con = null) Return the first auditTrail matching the query, or a new auditTrail object populated from the query conditions when no match is found
 *
 * @method auditTrail findOneByTimeIn(string $time_in) Return the first auditTrail filtered by the time_in column
 * @method auditTrail findOneByTimeOut(string $time_out) Return the first auditTrail filtered by the time_out column
 * @method auditTrail findOneByDate(string $date) Return the first auditTrail filtered by the date column
 * @method auditTrail findOneByLevel(string $level) Return the first auditTrail filtered by the level column
 *
 * @method array findById(int $id) Return auditTrail objects filtered by the id column
 * @method array findByTimeIn(string $time_in) Return auditTrail objects filtered by the time_in column
 * @method array findByTimeOut(string $time_out) Return auditTrail objects filtered by the time_out column
 * @method array findByDate(string $date) Return auditTrail objects filtered by the date column
 * @method array findByLevel(string $level) Return auditTrail objects filtered by the level column
 */
abstract class BaseauditTrailQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseauditTrailQuery object.
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
            $modelName = 'CoreBundle\\Model\\auditTrail';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new auditTrailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   auditTrailQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return auditTrailQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof auditTrailQuery) {
            return $criteria;
        }
        $query = new auditTrailQuery(null, null, $modelAlias);

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
     * @return   auditTrail|auditTrail[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = auditTrailPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(auditTrailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 auditTrail A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
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
     * @return                 auditTrail A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `time_in`, `time_out`, `date`, `level` FROM `audit_trail` WHERE `id` = :p0';
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
            $obj = new auditTrail();
            $obj->hydrate($row);
            auditTrailPeer::addInstanceToPool($obj, (string) $key);
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
     * @return auditTrail|auditTrail[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|auditTrail[]|mixed the list of results, formatted by the current formatter
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
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(auditTrailPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(auditTrailPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(auditTrailPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(auditTrailPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(auditTrailPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the time_in column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeIn('2011-03-14'); // WHERE time_in = '2011-03-14'
     * $query->filterByTimeIn('now'); // WHERE time_in = '2011-03-14'
     * $query->filterByTimeIn(array('max' => 'yesterday')); // WHERE time_in < '2011-03-13'
     * </code>
     *
     * @param     mixed $timeIn The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterByTimeIn($timeIn = null, $comparison = null)
    {
        if (is_array($timeIn)) {
            $useMinMax = false;
            if (isset($timeIn['min'])) {
                $this->addUsingAlias(auditTrailPeer::TIME_IN, $timeIn['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeIn['max'])) {
                $this->addUsingAlias(auditTrailPeer::TIME_IN, $timeIn['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(auditTrailPeer::TIME_IN, $timeIn, $comparison);
    }

    /**
     * Filter the query on the time_out column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeOut('2011-03-14'); // WHERE time_out = '2011-03-14'
     * $query->filterByTimeOut('now'); // WHERE time_out = '2011-03-14'
     * $query->filterByTimeOut(array('max' => 'yesterday')); // WHERE time_out < '2011-03-13'
     * </code>
     *
     * @param     mixed $timeOut The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterByTimeOut($timeOut = null, $comparison = null)
    {
        if (is_array($timeOut)) {
            $useMinMax = false;
            if (isset($timeOut['min'])) {
                $this->addUsingAlias(auditTrailPeer::TIME_OUT, $timeOut['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeOut['max'])) {
                $this->addUsingAlias(auditTrailPeer::TIME_OUT, $timeOut['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(auditTrailPeer::TIME_OUT, $timeOut, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date < '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(auditTrailPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(auditTrailPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(auditTrailPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the level column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel('fooValue');   // WHERE level = 'fooValue'
     * $query->filterByLevel('%fooValue%'); // WHERE level LIKE '%fooValue%'
     * </code>
     *
     * @param     string $level The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function filterByLevel($level = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($level)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $level)) {
                $level = str_replace('*', '%', $level);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(auditTrailPeer::LEVEL, $level, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   auditTrail $auditTrail Object to remove from the list of results
     *
     * @return auditTrailQuery The current query, for fluid interface
     */
    public function prune($auditTrail = null)
    {
        if ($auditTrail) {
            $this->addUsingAlias(auditTrailPeer::ID, $auditTrail->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
