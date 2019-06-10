<?php
/**
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
 * 05/17/2019
 * 328/328final/index.php
 * This file represent the all routes of website.
 **/

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Required file
require_once('vendor/autoload.php');
//validate form
require_once('model/formvalidation.php');
require_once'model/database.php';


$db = new Database();
session_start();

//Instantiate Fat-Free
$f3 = Base::instance();

$f3->set('states', array('Washington', 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'West Virginia', 'Wisconsin', 'Wyoming'));
$f3->set('types', array('Residential', 'Commercial'));


//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//Define a default route
$f3->route('GET /', function ($f3) {
    $f3->set('page_title', 'West Coast Power-Vac');

    //Display summary
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a home route
$f3->route('GET /home', function ($f3) {
    $f3->set('page_title', 'West Coast Power-Vac');


    //Display summary
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a about us route
$f3->route('GET /about', function ($f3) {
    $f3->set('page_title', 'About Us');


    //Display summary
    $view = new Template();
    echo $view->render('views/about.html');
});

//Define a services route
$f3->route('GET|POST /services', function ($f3) {
    $f3->set('page_title', 'Services');


    global $db;
    $_SESSION = array();
    $isValid = true;

    if (!empty($_POST)) {

        $fname = $_POST['first'];
        $lname = $_POST['last'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $zip = $_POST['zip'];
        $state = $_POST['state'];
        $type = $_POST['type'];
        $residentials = $_POST['residentials'];
        $additionals = $_POST['additionals'];
        $commercials = $_POST['commercials'];

        //Add data to hive
        $f3->set('first', $fname);
        $f3->set('last', $lname);
        $f3->set('email', $email);
        $f3->set('phone', $phone);
        $f3->set('address', $address);
        $f3->set('zip', $zip);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('type', $type);
        $f3->set('residentials', $residentials);
        $f3->set('additionals', $additionals);
        $f3->set('commercials', $commercials);


        // validate  first name
        if (validName($fname)) {
            $_SESSION['first'] = $fname;
        } else {
            $f3->set("errors['first']", "Please enter your first name");
            $isValid = false;
        }
        // validate  first name
        if (validName($lname)) {
            $_SESSION['last'] = $lname;
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

        //save all residential services
        if (!empty($_POST['residential'])) {
            $residential = $_POST['residential'];
            $f3->set('residential', $residential);
            //$outdoor_string = implode(', ', $outdoor);
            $_SESSION['residential'] = implode(', ', $residential);
        }

        //save all commercial services
        if (!empty($_POST['commercial'])) {
            $commercial = $_POST['commercial'];
            $f3->set('commercial', $commercial);
            //$outdoor_string = implode(', ', $outdoor);
            $_SESSION['commercial'] = implode(', ', $commercial);
        }

        if ($isValid) { //if residential was selected
            if (!empty($type) && $_POST['type'] === "Residential") {

                $residential = new residential($fname, $lname, $email, $phone, $state, $type);
                if (isset($_POST['address'])) {
                    $residential->setAddress($address);
                }
                if (isset($_POST['zip'])) {
                    $residential->setZip($zip);
                }
                $residentials = $_SESSION['residential'];
                $residential->setServices($residentials);
                $_SESSION['propertyType'] = $residential;

                //insert customer
                $db->insertCustomer($fname, $lname, $phone, $email, $address, $state, $zip, $type);

                $customer_id = $db->getCustomerID($fname, $lname);
                $selectedResidential = $_SESSION['residential'];

                $db->insertServices($customer_id, $selectedResidential);

            } else {
                //if commercial was selected
                $commercial = new commercial($fname, $lname, $email, $phone, $state, $zip, $type);
                if (isset($_POST['address'])) {
                    $commercial->setAddress($address);
                }
                if (isset($_POST['zip'])) {
                    $commercial->setZip($zip);
                }
                $commercials = $_SESSION['commercial'];
                $commercial->setServices($commercials);
                $_SESSION['propertyType'] = $commercial;

                $db->insertCustomer($fname, $lname, $phone, $email, $address, $state, $zip, $type);

                $customer_id = $db->getCustomerID($fname, $lname);
                $selectedCommercial = $_SESSION['commercial'];

                //insert services
                $db->insertServices($customer_id['customer_id'], $selectedCommercial);
            }
        }
    }
    $db->connect();
    //get residential services
    $residentials = $db->getResidential();

    //set residential and db
    $f3->set('residentials', $residentials);
    $f3->set('db', $db);

    //get additional services
    $additionals = $db->getAdditional();

    //set residential and db
    $f3->set('additionals', $additionals);
    $f3->set('db', $db);

    //get commercial services
    $commercials = $db->getCommercial();

    //set customers and db
    $f3->set('commercials', $commercials);
    $f3->set('db', $db);

    //get estimates
    $estimates = $db->getEstimates();

    //set customers and db
    $f3->set('estimates', $estimates);
    $f3->set('db', $db);


    //Display summary
    $view = new Template();
    echo $view->render('views/services.html');

});

//Define a contact route
$f3->route('GET|POST /reviews', function ($f3) {
    global $db;
    $isValid = true;

    if (!empty($_POST)) {

        $firstn = $_POST['firstn'];
        $lastn = $_POST['lastn'];
        $review = $_POST['review'];

        //Add data to hive
        $f3->set('firstn', $firstn);
        $f3->set('lastn', $lastn);
        $f3->set('review', $review);

        // validate  first name
        if (validName($firstn)) {
            $_SESSION['firstn'] = $firstn;
        } else {
            $f3->set("errors['firstn']", "Please enter your first name");
            $isValid = false;
        }
        // validate  first name
        if (validName($lastn)) {
            $_SESSION['lastn'] = $lastn;
        } else {
            $f3->set("errors['lastn']", "Please enter your last name");
            $isValid = false;
        }

        if (!empty($review)) {
            $_SESSION['review'] = $review;
        } else {
            $f3->set("errors['review']", "Please enter a review.");
            $isValid = false;
        }

        if ($isValid) {
            $db->insertReview($firstn, $lastn,$review);
            $f3->set("errors['submitreview']", "Thank you for submitting a review.");
        }
    }

    //get reviews
    $db->connect();
    $reviews = $db->getReviews();

    //set members and db for use in admin
    $f3->set('reviews', $reviews);
    $f3->set('db', $db);

    //Display summary
    $view = new Template();
    echo $view->render('views/reviews.html');
});

//Define a contact route
$f3->route('GET|POST /contact', function ($f3) {
    $f3->set('page_title', 'Contact');

    global $db;
    $_SESSION = array();
    $isValid = true;

    if (!empty($_POST)) {

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        //Add data to hive
        $f3->set('firstname', $fname);
        $f3->set('lastname', $lname);
        $f3->set('email', $email);
        $f3->set('phone', $phone);
        $f3->set('message', $message);

        // validate  first name
        if (validName($fname)) {
            $_SESSION['firstname'] = $fname;
        } else {
            $f3->set("errors['first']", "Please enter your first name");
            $isValid = false;
        }
        // validate  first name
        if (validName($lname)) {
            $_SESSION['last'] = $lname;
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
            $db->insertContact($fname, $lname, $phone, $email, $message);
            $f3->set("errors['submitcontact']", "Thank you for Contacting, We will get to you soon.");
        }

        //get contact info
        $contacts = $db->getContacts();

        //set members and db for use in admin
        $f3->set('contacts', $contacts);
        $f3->set('db', $db);
    }
    //Display summary
    $view = new Template();
    echo $view->render('views/contact.html');
});

//admin route
$f3->route('GET|POST /admin', function ($f3) {
    $f3->set('page_title', 'Admin');


    global $db;
    $db->connect();
    $customers = $db->getCustomers();

    //set customers and db for use in admin
    $f3->set('customers', $customers);
    $f3->set('db', $db);

    //get reviews
    $reviews = $db->getReviews();

    //set reviews and db for use in admin
    $f3->set('reviews', $reviews);
    $f3->set('db', $db);

    //get contacts
    $contacts = $db->getContacts();

    //set contacts and db for use in admin
    $f3->set('contacts', $contacts);
    $f3->set('db', $db);

    //get estimates
    $estimates = $db->getEstimates();

    //set contacts and db for use in admin
    $f3->set('estimates', $estimates);
    $f3->set('db', $db);

    //get services
    $services = $db->getServices();

    //set contacts and db for use in admin
    $f3->set('services', $services);
    $f3->set('db', $db);


    //display a view
    $view = new Template();
    echo $view->render('views/admin.html');
});

// route to edit customer
$f3->route("GET|POST /edit/@customer_id", function($f3, $params) {

    global $db;
    $id = $params['customer_id'];
    $customer = $db->getCustomer($id);

    $f3->set("customer", $customer);

    //update data
    if(isset($_POST['save'])) {

        //get post data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $type = $_POST['type'];

        $db->updateCustomer($id, $fname, $lname, $phone, $email, $address, $state, $zip, $type);
        $f3->reroute("admin");
    }

    //confirm deletion of customer
    if(isset($_POST['delete'])) {
        $db->deleteEstimate($id);
        $f3->reroute("admin");
    }

    $template = new Template();
    echo $template->render('views/edit_customer.html');
});

// route to delete entry
$f3->route("GET|POST /delete/@estimate_id", function($f3, $params) {

    global $db;
    $id = $params['estimate_id'];
    $estimate = $db->getEstimate($id);

    $f3->set("estimate", $estimate);


    //confirm deletion of customer
    if(isset($_POST['delete'])) {
        $db->deleteEstimate($id);
        $f3->reroute("admin");
    }

    $template = new Template();
    echo $template->render('views/delete_entry.html');
});

//Run Fat-Free
$f3->run();

