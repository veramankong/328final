<?php
/**
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
 * 06/05/2019
 * 328/328final/model/lookup.php
 * This file get user's info for user when user input the service estimate id if they have one.
 **/
// print_r($_POST);
$id = $_POST['pid'];

error_reporting(E_ALL);
ini_set("display_errors", 1);
$user = $_SERVER['USER'];
//require "/home/$user/config.php";
require "/home/$user/config.php";

//Connect to the DB
try {
    //instantiate a database object
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    return;
}
if (empty($_POST)) {
    echo "Enter a Service Estimate ID.";
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
        echo $row['fname'] . ', ' . $row['lname'] . $row['email'] . ', ' . $row['type'];
    } else {
        echo " Enter a Service Estimate ID.";
    }
}



