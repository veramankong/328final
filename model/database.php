<?php
/* <!--
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
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
address VARCHAR(100),
state VARCHAR(30) NOT NUll,
zip int(6),
type varchar(20) NOT NULL,
services VARCHAR(500) NULL
)
 */

/*
CREATE TABLE services (
service_id INT AUTO_INCREMENT PRIMARY KEY,
services VARCHAR(50) NOT NULL,
type varchar(20) NOT NULL
)
 */

/*
CREATE TABLE estimates (
FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
FOREIGN KEY (services_id) REFERENCES services(services_id),
estimate VARCHAR(50) NOT NULL
)
 */

/*
CREATE TABLE contact (
fname VARCHAR(50) NOT NULL,
lname VARCHAR(50) NOT NULL,
phone VARCHAR(20) NOT NULL,
email VARCHAR(100) NOT NULL,
message VARCHAR(500) NULL
)
 */

/*

CREATE TABLE reviews (
fname VARCHAR(50) NOT NULL,
lname VARCHAR(50) NOT NULL,
review VARCHAR(500) NOT NULL
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
    private $_db;

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
            $this->_db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            return $this->_db;
            echo "connected to database!";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function insertCustomer($fname, $lname, $phone, $email, $address = "No address",
                            $state,
                            $zip = 'No Zip Code',
                            $type,
                            $services)
    {
        //define query
        $query = 'INSERT INTO customer
                  (fname, lname, phone, email, address, state, zip, type, services)
                  VALUES(:fname, :lname, :phone, :email, :address, :state, :zip, :type, :services)';

        //prepare statement
        $statement = $this->_db->prepare($query);
        //bind parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
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

    /**
     * Get all customers
     * @return mixed
     */
    function getCustomers()
    {
        //define query
        $query = "SELECT * FROM customer";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //execute
        $statement->execute();

        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function insertContact($firstname, $lastname, $phone, $email, $message)
    {
        //define query
        $query = 'INSERT INTO contact
                  (firstname, lastname, phone, email, message)
                  VALUES(:firstname, :lastname, :phone, :email, :message)';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':message', $message, PDO::PARAM_INT);

        //execute statement
        $statement->execute();
    }

    //get customer_id
    function getCustomerID($fname, $lname)
    {
        //define query
        $query = "SELECT member_id FROM customer
                  WHERE fname = :fname 
                  AND lname = :lname";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':fname', $fname);
        $statement->bindParam(':lname', $lname);

        //execute
        $statement->execute();

        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //insert customer id
    function insertContactCustomerId($member_id)
    {
        //define query
        $query = 'INSERT INTO contact (member_id)
                  VALUES (:member_id)';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
    }


    function insertreview($firstn, $lastn, $review)
    {
        //define query
        $query = 'INSERT INTO reviews
                  (fname, lname, review)
                  VALUES(:firstn, :lastn,:review)';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':firstn', $firstn, PDO::PARAM_STR);
        $statement->bindParam(':lastn', $lastn, PDO::PARAM_STR);
        $statement->bindParam(':review', $review, PDO::PARAM_INT);

        //execute statement
        $statement->execute();
    }
}
