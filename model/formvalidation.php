<?php
/**
 * Name: Sukhveer S Jawandha & Vera Mankongvanichkul
 * 06/05/2019
 * 328/328final/model/formvalidation.php
 * This file conatins methods to validate the form.
 **/

// first name validation
/**
 * validate the name
 * @param String $name name of user
 * @return bool
 */
function validName($name) {
    //checks to see that a string is all alphabetic
    return
        (
            (!empty($name)) && ctype_alpha($name));
}

/**
 * validate the phone
 * @param String $phone phone of user
 * @return bool
 */
// phone number validation
function validPhone($phone) {
    //if user uses parentheses, dashes, or spaces
    // strip phone to just numbers
    $phone = str_replace("-", "", $phone);
    $phone = str_replace(" ", "", $phone);
    $phone = str_replace("(", "", $phone);
    $phone = str_replace(")", "", $phone);

    return (is_numeric($phone)) && (strlen($phone) == 10);
}

