
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- employee_registration
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employee_registration`;

CREATE TABLE `employee_registration`
(
    `emp_id` INTEGER NOT NULL AUTO_INCREMENT,
    `emp_fname` VARCHAR(255) NOT NULL,
    `emp_lname` VARCHAR(255) NOT NULL,
    `emp_username` VARCHAR(255) NOT NULL,
    `emp_password` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
