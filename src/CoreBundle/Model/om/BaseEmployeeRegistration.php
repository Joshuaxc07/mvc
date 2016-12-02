<?php

namespace CoreBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use CoreBundle\Model\EmployeeRegistration;
use CoreBundle\Model\EmployeeRegistrationPeer;
use CoreBundle\Model\EmployeeRegistrationQuery;

abstract class BaseEmployeeRegistration extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'CoreBundle\\Model\\EmployeeRegistrationPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        EmployeeRegistrationPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the emp_id field.
     * @var        int
     */
    protected $emp_id;

    /**
     * The value for the emp_fname field.
     * @var        string
     */
    protected $emp_fname;

    /**
     * The value for the emp_lname field.
     * @var        string
     */
    protected $emp_lname;

    /**
     * The value for the emp_username field.
     * @var        string
     */
    protected $emp_username;

    /**
     * The value for the emp_password field.
     * @var        string
     */
    protected $emp_password;

    /**
     * The value for the role field.
     * @var        string
     */
    protected $role;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * Get the [emp_id] column value.
     *
     * @return int
     */
    public function getEmpId()
    {

        return $this->emp_id;
    }

    /**
     * Get the [emp_fname] column value.
     *
     * @return string
     */
    public function getEmpFname()
    {

        return $this->emp_fname;
    }

    /**
     * Get the [emp_lname] column value.
     *
     * @return string
     */
    public function getEmpLname()
    {

        return $this->emp_lname;
    }

    /**
     * Get the [emp_username] column value.
     *
     * @return string
     */
    public function getEmpUsername()
    {

        return $this->emp_username;
    }

    /**
     * Get the [emp_password] column value.
     *
     * @return string
     */
    public function getEmpPassword()
    {

        return $this->emp_password;
    }

    /**
     * Get the [role] column value.
     *
     * @return string
     */
    public function getRole()
    {

        return $this->role;
    }

    /**
     * Set the value of [emp_id] column.
     *
     * @param  int $v new value
     * @return EmployeeRegistration The current object (for fluent API support)
     */
    public function setEmpId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->emp_id !== $v) {
            $this->emp_id = $v;
            $this->modifiedColumns[] = EmployeeRegistrationPeer::EMP_ID;
        }


        return $this;
    } // setEmpId()

    /**
     * Set the value of [emp_fname] column.
     *
     * @param  string $v new value
     * @return EmployeeRegistration The current object (for fluent API support)
     */
    public function setEmpFname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_fname !== $v) {
            $this->emp_fname = $v;
            $this->modifiedColumns[] = EmployeeRegistrationPeer::EMP_FNAME;
        }


        return $this;
    } // setEmpFname()

    /**
     * Set the value of [emp_lname] column.
     *
     * @param  string $v new value
     * @return EmployeeRegistration The current object (for fluent API support)
     */
    public function setEmpLname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_lname !== $v) {
            $this->emp_lname = $v;
            $this->modifiedColumns[] = EmployeeRegistrationPeer::EMP_LNAME;
        }


        return $this;
    } // setEmpLname()

    /**
     * Set the value of [emp_username] column.
     *
     * @param  string $v new value
     * @return EmployeeRegistration The current object (for fluent API support)
     */
    public function setEmpUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_username !== $v) {
            $this->emp_username = $v;
            $this->modifiedColumns[] = EmployeeRegistrationPeer::EMP_USERNAME;
        }


        return $this;
    } // setEmpUsername()

    /**
     * Set the value of [emp_password] column.
     *
     * @param  string $v new value
     * @return EmployeeRegistration The current object (for fluent API support)
     */
    public function setEmpPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->emp_password !== $v) {
            $this->emp_password = $v;
            $this->modifiedColumns[] = EmployeeRegistrationPeer::EMP_PASSWORD;
        }


        return $this;
    } // setEmpPassword()

    /**
     * Set the value of [role] column.
     *
     * @param  string $v new value
     * @return EmployeeRegistration The current object (for fluent API support)
     */
    public function setRole($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->role !== $v) {
            $this->role = $v;
            $this->modifiedColumns[] = EmployeeRegistrationPeer::ROLE;
        }


        return $this;
    } // setRole()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->emp_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->emp_fname = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->emp_lname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->emp_username = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->emp_password = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->role = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = EmployeeRegistrationPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating EmployeeRegistration object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EmployeeRegistrationPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = EmployeeRegistrationPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EmployeeRegistrationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = EmployeeRegistrationQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(EmployeeRegistrationPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                EmployeeRegistrationPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = EmployeeRegistrationPeer::EMP_ID;
        if (null !== $this->emp_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmployeeRegistrationPeer::EMP_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_ID)) {
            $modifiedColumns[':p' . $index++]  = '`emp_id`';
        }
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_FNAME)) {
            $modifiedColumns[':p' . $index++]  = '`emp_fname`';
        }
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_LNAME)) {
            $modifiedColumns[':p' . $index++]  = '`emp_lname`';
        }
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`emp_username`';
        }
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`emp_password`';
        }
        if ($this->isColumnModified(EmployeeRegistrationPeer::ROLE)) {
            $modifiedColumns[':p' . $index++]  = '`role`';
        }

        $sql = sprintf(
            'INSERT INTO `employee_registration` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`emp_id`':
                        $stmt->bindValue($identifier, $this->emp_id, PDO::PARAM_INT);
                        break;
                    case '`emp_fname`':
                        $stmt->bindValue($identifier, $this->emp_fname, PDO::PARAM_STR);
                        break;
                    case '`emp_lname`':
                        $stmt->bindValue($identifier, $this->emp_lname, PDO::PARAM_STR);
                        break;
                    case '`emp_username`':
                        $stmt->bindValue($identifier, $this->emp_username, PDO::PARAM_STR);
                        break;
                    case '`emp_password`':
                        $stmt->bindValue($identifier, $this->emp_password, PDO::PARAM_STR);
                        break;
                    case '`role`':
                        $stmt->bindValue($identifier, $this->role, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setEmpId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = EmployeeRegistrationPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EmployeeRegistrationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getEmpId();
                break;
            case 1:
                return $this->getEmpFname();
                break;
            case 2:
                return $this->getEmpLname();
                break;
            case 3:
                return $this->getEmpUsername();
                break;
            case 4:
                return $this->getEmpPassword();
                break;
            case 5:
                return $this->getRole();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['EmployeeRegistration'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['EmployeeRegistration'][$this->getPrimaryKey()] = true;
        $keys = EmployeeRegistrationPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getEmpId(),
            $keys[1] => $this->getEmpFname(),
            $keys[2] => $this->getEmpLname(),
            $keys[3] => $this->getEmpUsername(),
            $keys[4] => $this->getEmpPassword(),
            $keys[5] => $this->getRole(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = EmployeeRegistrationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setEmpId($value);
                break;
            case 1:
                $this->setEmpFname($value);
                break;
            case 2:
                $this->setEmpLname($value);
                break;
            case 3:
                $this->setEmpUsername($value);
                break;
            case 4:
                $this->setEmpPassword($value);
                break;
            case 5:
                $this->setRole($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = EmployeeRegistrationPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setEmpId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setEmpFname($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEmpLname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setEmpUsername($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEmpPassword($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRole($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(EmployeeRegistrationPeer::DATABASE_NAME);

        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_ID)) $criteria->add(EmployeeRegistrationPeer::EMP_ID, $this->emp_id);
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_FNAME)) $criteria->add(EmployeeRegistrationPeer::EMP_FNAME, $this->emp_fname);
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_LNAME)) $criteria->add(EmployeeRegistrationPeer::EMP_LNAME, $this->emp_lname);
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_USERNAME)) $criteria->add(EmployeeRegistrationPeer::EMP_USERNAME, $this->emp_username);
        if ($this->isColumnModified(EmployeeRegistrationPeer::EMP_PASSWORD)) $criteria->add(EmployeeRegistrationPeer::EMP_PASSWORD, $this->emp_password);
        if ($this->isColumnModified(EmployeeRegistrationPeer::ROLE)) $criteria->add(EmployeeRegistrationPeer::ROLE, $this->role);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(EmployeeRegistrationPeer::DATABASE_NAME);
        $criteria->add(EmployeeRegistrationPeer::EMP_ID, $this->emp_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getEmpId();
    }

    /**
     * Generic method to set the primary key (emp_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setEmpId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getEmpId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of EmployeeRegistration (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmpFname($this->getEmpFname());
        $copyObj->setEmpLname($this->getEmpLname());
        $copyObj->setEmpUsername($this->getEmpUsername());
        $copyObj->setEmpPassword($this->getEmpPassword());
        $copyObj->setRole($this->getRole());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setEmpId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return EmployeeRegistration Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return EmployeeRegistrationPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new EmployeeRegistrationPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->emp_id = null;
        $this->emp_fname = null;
        $this->emp_lname = null;
        $this->emp_username = null;
        $this->emp_password = null;
        $this->role = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmployeeRegistrationPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
