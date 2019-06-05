<?php
/* Sukhveer S Jawandha
 * 06/05/2019
 * 328/328final/model/database.php
 * Database functions to connect database
 */

/*
CREATE TABLE customer (
customer_id INT AUTO_INCREMENT PRIMARY KEY,
fname VARCHAR(50) NOT NULL,
lname VARCHAR(50) NOT NULL,
phone VARCHAR(20) NOT NULL,
email VARCHAR(100) NOT NULL,
state VARCHAR(30),
zip int(6),
type varchar(20),
services VARCHAR(500)
);
 */
require "/home2/sjawandh/config-student.php";

/**
 * database Class is for a database for customers
 *
 * The customer class represents a customer.
 *
 * The database class represents a database to insert and get the data of customer.
 * @author Sukhveer S Jawandha <sjawandha2@mail.greenriver.edu>
 * @copyright 2019
 */
class Database
{
    private $_dbh;

    /**
     * Database constructor.
     */
    // constructor
    function __construct()
    {
        $this->connect();
    }

    // connect to database

    /**
     *
     * connect to the database
     * @return PDO the database
     *
     */
    function connect()
    {
        try {
            // instantiate a db object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            return $this->_dbh;
//            echo "connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
