<?php
/**
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
 * 05/17/2019
 * 328/328final/index.php
 **/

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Database config
$user = $_SERVER['USER'];
//require "/home/$user/config.php";

//Required file
require_once('vendor/autoload.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a home route
$f3->route('GET /home', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a contact route
$f3->route('GET /contact', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/contact.html');
});

//Run Fat-Free
$f3->run();