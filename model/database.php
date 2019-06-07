<?php
/* <!--
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
 * 06/05/2019
 * 328/328final/model/database.php
 * Database functions to connect database
 */

/*
CREATE TABLE customer ( customer_id INT AUTO_INCREMENT PRIMARY KEY,
 fname VARCHAR(50) NOT NULL,
 lname VARCHAR(50) NOT NULL,
phone VARCHAR(20) NOT NULL,
email VARCHAR(100) NOT NULL,
address VARCHAR(100),
state VARCHAR(30) NOT NUll,
zip int(6),
type varchar(20) NOT NULL,
services VARCHAR(500) NULL
)
 */
$user = $_SERVER['USER'];
require "/home2/$user/config.php";

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

    function insertCustomer($first, $last, $phone, $email, $address = "No address",
                            $zip = 'No Zip Code',
                            $state,
                            $type,
                            $services)
    {
        //define query
        $query = 'INSERT INTO customer
                  (fname, lname, phone, email,address, state, zip, type, services)VALUES(:first, :last, :phone, :email,:address, :state, :zip, :type, :services)';

        //prepare statement
        $statement = $this->_dbh->prepare($query);
        //bind parameters
        $statement->bindParam(':fname', $first, PDO::PARAM_STR);
        $statement->bindParam(':lname', $last, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        $statement->bindParam(':type', $type, PDO::PARAM_STR);
        $statement->bindParam(':services', $services, PDO::PARAM_INT);
        //execute statement
        $statement->execute();
    }

}
