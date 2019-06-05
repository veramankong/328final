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

session_start();
//validate form
require_once('model/formvalidation.php');

//Instantiate Fat-Free
$f3 = Base::instance();

$f3->set('states', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'));
$f3->set('types', array('Residential', 'Commercial'));

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function () {

    //Display summary
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a home route
$f3->route('GET /home', function () {

    //Display summary
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a about us route
$f3->route('GET /about', function () {

    //Display summary
    $view = new Template();
    echo $view->render('views/about.html');
});

//Define a services route
$f3->route('GET|POST /services', function ($f3) {

    $_SESSION = array();
    $isValid = true;

    if (!empty($_POST)) {

        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $zip = $_POST['zip'];
        $state = $_POST['state'];
        $type = $_POST['type'];

        //Add data to hive
        $f3->set('first', $first);
        $f3->set('last', $last);
        $f3->set('email', $email);
        $f3->set('phone', $phone);
        $f3->set('address', $address);
        $f3->set('zip', $zip);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('type', $type);


        // validate  first name
        if (validName($first)) {
            $_SESSION['first'] = $first;
        } else {
            $f3->set("errors['first']", "Please enter your first name");
            $isValid = false;
        }
        // validate  first name
        if (validName($last)) {
            $_SESSION['last'] = $last;
        } else {
            $f3->set("errors['last']", "Please enter your last name");
            $isValid = false;
        }

        if (!empty($email)) {
            $_SESSION['email'] = $email;

        } else {
            $f3->set("errors['email']", "Please enter your email address");
            $isValid = false;
        }

        // validate phone number
        if (validPhone($phone)) {
            $_SESSION['phone'] = $phone;

        } else {
            $f3->set("errors['phone']", "Please enter 10 digit phone number");
            $isValid = false;
        }

        // saves address if set
        if (isset($_POST['address'])) {
            $_SESSION['address'] = $address;
        }
        if (isset($_POST['zip'])) {
            $_SESSION['zip'] = $zip;
        }

        if (isset($_POST['state'])) {
            $state = $_POST['state'];
            if ($state != "") {
                $_SESSION['state'] = $state;

            } else {
                $f3->set("error['state']", "Please select a state.");
                $isValid = false;
            }
        }
        if (isset($_POST['type'])) {
            $_SESSION['type'] = $type;
        }
//            print_r($_SESSION['propertyType']);
        if ($isValid) {
// print Service ID for client

            if ($_SESSION["type"] == "Commercial") {


//                $commercial = new commercialcustomer($name, $email, $phone, $state, $type);
//                $_SESSION['propertyType'] = $commercial;
                $f3->reroute("/commercialservices");
            } else {
//                $customer = new customer($name, $email, $phone, $state, $type);
//                $_SESSION['propertyType'] = $customer;
                $f3->reroute("/residentialservices");
            }
        }
    }

    //Display summary
    $view = new Template();
    echo $view->render('views/services.html');

});

// residential services
$f3->route('GET|POST /residentialservices', function () {

    //Display summary
    $view = new Template();
    echo $view->render('views/residentialservices.html');
});


$f3->route('GET|POST /commercialservices', function () {

    //Display summary
    $view = new Template();
    echo $view->render('views/commercialservices.html');
});

//Define a contact route
$f3->route('GET /reviews', function () {

    //Display summary
    $view = new Template();
    echo $view->render('views/reviews.html');
});

//Define a contact route
$f3->route('GET|POST /contact', function ($f3) {

    $_SESSION = array();
    $isValid = true;

    if (!empty($_POST)) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        //Add data to hive
        $f3->set('firstname', $firstname);
        $f3->set('lastname', $lastname);
        $f3->set('email', $email);
        $f3->set('phone', $phone);
        $f3->set('message', $message);

        // validate  first name
        if (validName($firstname)) {
            $_SESSION['firstname'] = $firstname;
        } else {
            $f3->set("errors['first']", "Please enter your first name");
            $isValid = false;
        }
        // validate  first name
        if (validName($lastname)) {
            $_SESSION['last'] = $lastname;
        } else {
            $f3->set("errors['last']", "Please enter your last name");
            $isValid = false;
        }

        if (!empty($email)) {
            $_SESSION['email'] = $email;

        } else {
            $f3->set("errors['email']", "Please enter your email address");
            $isValid = false;
        }

        // validate phone number
        if (validPhone($phone)) {
            $_SESSION['phone'] = $phone;

        } else {
            $f3->set("errors['phone']", "Please enter 10 digit phone number");
            $isValid = false;
        }

        if (!empty($message)) {
            $_SESSION['message'] = $message;
        }

        if ($isValid) {
//            $f3->reroute("/reviews");
        }
    }
    //Display summary
    $view = new Template();
    echo $view->render('views/contact.html');
});

//admin route
$f3->route('GET|POST /admin', function ($f3) {

//    global $db;
//    $db->connect();
//    $members = $db->getMembers();
//    //set members and db for use in admin
//    $f3->set('members', $members);
//    $f3->set('db', $db);
    //display a view
    $view = new Template();
    echo $view->render('views/admin.html');
});

//Run Fat-Free
$f3->run();