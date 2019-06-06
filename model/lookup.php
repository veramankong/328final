<?php
/**
 * Created by PhpStorm.
 * User: sjawa
 * Date: 6/1/2019
 * Time: 12:45 PM
 */
// print_r($_POST);
$id = $_POST['pid'];

error_reporting(E_ALL);
ini_set("display_errors", 1);
$user = $_SERVER['USER'];
//require "/home/$user/config.php";
require "/home2/$user/config.php";

//Connect to the DB
try {
    //instantiate a database object
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    return;
}

if (!empty($_POST)) {
    if (is_numeric($id)) {
        //Define the query
        $sql = "SELECT* FROM customer WHERE customer_id = :custid";
//bind the parameter
        $custid = $_POST['pid'];
        $statement = $dbh->prepare($sql);


        $statement->bindParam(':custid', $custid, PDO::PARAM_INT);

// Execute the statement
        $statement->execute();

//process the result
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        echo $row['fname'] . ', ' . $row['lname'] . $row['email'] . ', ' . $row['type'] . $row['services'];
    } else {
        echo "Please Enter a Service Estimate ID.";
    }
}

if (empty($_POST)) {
    echo "Please Enter a Service Estimate ID.";
}

