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
)
*/

/*
CREATE TABLE services (
service_id INT AUTO_INCREMENT PRIMARY KEY,
service VARCHAR(50) NOT NULL,
type varchar(20) NOT NULL,
price int(10) NOT NULL
)
*/

/*
CREATE TABLE estimates (
estimate_id INT AUTO_INCREMENT PRIMARY KEY,
customer_id int NOT NULL,
services VARCHAR(500) NOT NULL,
FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
estimate VARCHAR(50) NOT NULL
)

CREATE TABLE estimates (
estimate_id INT AUTO_INCREMENT PRIMARY KEY,
customer_id int NULL,
services VARCHAR(500) NULL
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
review_id INT AUTO_INCREMENT PRIMARY KEY,
fname VARCHAR(50) NOT NULL,
lname VARCHAR(50) NOT NULL,
review VARCHAR(500) NOT NULL
)
*/


$user = $_SERVER['USER'];
require "/home/$user/config.php";

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
                            $type)
    {
        //define query
        $query = 'INSERT INTO customer
                  (fname, lname, phone, email, address, state, zip, type)
                  VALUES(:fname, :lname, :phone, :email, :address, :state, :zip, :type)';

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

    //get single customer
    function getCustomer($customer_id)
    {
        //define query
        $query = "SELECT * FROM customer
                  WHERE customer_id = :customer_id";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':customer_id', $customer_id);

        //execute
        $statement->execute();

        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function insertContact($fname, $lname, $phone, $email, $message)
    {
        //define query
        $query = 'INSERT INTO contact
                  (fname, lname, phone, email, message)
                  VALUES(:fname, :lname, :phone, :email, :message)';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':message', $message, PDO::PARAM_INT);

        //execute statement
        $statement->execute();
    }

    function getContacts()
    {
        //define query
        $query = "SELECT * FROM contact";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //execute
        $statement->execute();

        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //get customer_id
    function getCustomerID($email)
    {
        //define query
        $query = "SELECT customer_id FROM customer
                  WHERE email = :email ";


        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':email', $email);
//        $statement->bindParam(':lname', $lname);

        //execute
        $statement->execute();

        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //update customer
    function updateCustomer($customer_id, $fname, $lname, $phone, $email, $address, $state, $zip, $type)
    {
        //define query
        $query = 'UPDATE customer 
                  SET fname = :fname,
                  lname = :lname,
                  phone = :phone,
                  email = :email,
                  address = :address,
                  state = :state,
                  zip = :zip,
                  type = :type
                  WHERE customer_id = :customer_id';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        $statement->bindParam(':type', $type, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
    }

    //delete customer
    function deleteCustomer($customer_id)
    {
        //define query
        $query = 'DELETE FROM customer
                  WHERE customer_id = :customer_id
                  LIMIT 1';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameter
        $statement->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
    }

    function insertReview($firstn, $lastn, $review)
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

    function getReviews()
    {
        //define query
        $query = "SELECT fname, lname, review FROM reviews
                    ORDER BY review_id DESC";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //execute
        $statement->execute();

        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //gets residential services
    function getResidential()
    {
        //define query
        $query = "SELECT * FROM services
                   WHERE type = 'Residential'";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //execute
        $statement->execute();

        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //gets commercial services
    function getCommercial()
    {
        //define query
        $query = "SELECT * FROM services
                   WHERE type = 'Commercial'";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //execute
        $statement->execute();

        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    //inserts into estimates table
    function insertServices($customer_id, $services)
    {
        //define query
        $query = 'INSERT INTO estimates
                  (customer_id, services)
                  VALUES(:customer_id, :services)';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
        $statement->bindParam(':services', $services, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
    }

    function getEstimates()
    {
        //define query
        $query = "SELECT * FROM estimates";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //execute
        $statement->execute();

        //get results
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    function setEstimate($customer_id, $services)
    {
        //define query
        $query = 'INSERT INTO estimates
                  (customer_id, services)
                  VALUES(:customer_id, :services)';

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
        $statement->bindParam(':services', $services, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
    }

    function getService($service_id)
    {
        //define query
        $query = "SELECT service FROM services
                  WHERE service_id = :service_id";

        //prepare statement
        $statement = $this->_db->prepare($query);

        //bind parameters
        $statement->bindParam(':service_id', $service_id);

        //execute
        $statement->execute();

        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
