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
INSERT INTO services(services, type, price)
VALUES
('Air Duct Cleaning (1k-2k sq ft)', 'Residential', '259'),
('Full Service Package Bundle (1k-2k sq ft)', 'Residential', '399'),
('Air Duct Cleaning (2k-3k sq ft)', 'Residential', '299'),
('Full Service Package Bundle (2k-3k sq ft)', 'Residential', '459'),
('Air Duct Cleaning (3k-4k sq ft)', 'Residential', '359'),
('Full Service Package Bundle (3k-4k sq ft)', 'Residential', '499'),
('Air Duct Cleaning (4k-5k sq ft)', 'Residential', '399'),
('Full Service Package Bundle (4k-5k sq ft)', 'Residential', '559'),
('Air Duct Cleaning (2k-3k sq ft)', 'Commercial', '359'),
('Full Service Package Bundle (2k-3k sq ft)', 'Commercial', '499'),
('Air Duct Cleaning (3k-4k sq ft)', 'Commercial', '399'),
('Full Service Package Bundle (3k-4k sq ft)', 'Commercial', '559'),
('Air Duct Cleaning (4k-5k sq ft)', 'Commercial', '459'),
('Full Service Package Bundle (4k-5k sq ft)', 'Commercial', '599'),
('Air Duct Cleaning (5k-6k sq ft)', 'Commercial', '499'),
('Full Service Package Bundle (5k-6k sq ft)', 'Commercial', '659');
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
//require "/home/$user/config.php";
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

    /**
     * Get all customers by customer id
     * @param $customer_id
     * @return mixed
     */
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

    /**
     * Insert contact info
     * @param String $fname first name of user
     * @param String $lname last name of user
     * @param String $phone phone number of user
     * @param string $email email of user
     * @param string $message message of user
     */
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

    /**
     * Get all contacts
     * @return mixed contact info
     */
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

    /**
     * Get customer id by email
     * @param String $email email of user
     * @return mixed customer id
     */
    //get customer_id
    function getCustomerID($email)
    {
        //define query
        $query = "SELECT customer_id FROM customer
                  WHERE email = :email";


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

    /**
     * update the info of user
     * @param int $customer_id customer id of user
     * @param String $fname first name of user
     * @param  String $lname last name  of user
     * @param String $phone phone of user
     * @param  String $email email of user
     * @param  String $address address of user
     * @param String $state state of user
     * @param String $zip zip code of user
     * @param String $type property type of user
     */
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

    /**
     * delete customer by customer id
     * @param int $customer_id
     */
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

    /**
     * insert review info
     * @param String $firstn firstname of user
     * @param String $lastn lastname of user
     * @param String $review review of user
     */
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

    /**
     * get reviews
     * @return mixed reviews
     */
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

    /**
     * get residential services
     * @return mixed services
     */
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

    /**
     * get commercial services
     * @return mixed services
     */
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

    /**
     * insert  services
     * @return mixed services
     * @param int $customer_id customer id of customer
     * @param String $services services
     */
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

    /**
     * get estimate
     * @return mixed estimates
     */
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

    /**
     * insert estimates
     * @param int $customer_id customer id of customer
     * @param String $services services
     */
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

    /**
     * get ther services
     * @param int $service_id service id
     * @return mixed services
     */
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
