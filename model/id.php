<?php
/**
 * Created by PhpStorm.
 * User: sjawa
 * Date: 6/6/2019
 * Time: 12:45 PM
 */


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
    $sql = "SELECT MAX(customer_id) FROM customer";
//Prepare the statement
    $statement = $dbh->prepare($sql);

//Execute
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
        echo ($result+1);



