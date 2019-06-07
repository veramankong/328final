<?php
/**
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
 * 06/05/2019
 * 328/328final/model/id.php
 * This file give new customer a available id from database
 **/


error_reporting(E_ALL);
ini_set("display_errors",1);
$user = $_SERVER['USER'];

//require "/home/$user/config.php";
require "/home2/$user/config.php";

//Connect to the DB
try{
    //instantiate a database object
    $dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
}
catch (PDOException $e)
{
    echo $e->getMessage();
    return;
}

    //Define the query
    $sql = "SELECT MAX(customer_id+1) FROM customer";
//Prepare the statement
    $statement = $dbh->prepare($sql);

//Execute
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    foreach ($result as $id){
        echo ("Your customer ID is: " . $id);
    }




