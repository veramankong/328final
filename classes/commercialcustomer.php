<?php
/**
 * The premium member class represents a member as a premium member in dating website.
 *
 * The member class represents a member as a premium member  with a name, age,gender,phone,
 * email,state,seeking,bio, and interests.
 * @author Sukhveer S Jawandha <sjawandha2@mail.greenriver.edu>
 * @copyright 2019
 */


class commercialcustomer extends customer
{
    private $_services;
//    private $_services = array();


    function __construct($name, $email, $phone, $state, $type)
    {
        // parent constructor call
        parent::__construct($name, $phone, $email, $state, $type);
    }

    public function getServices()
    {
        return $this->_services;
    }


    public function setServices($services)
    {
        $this->_services = $services;
    }


}
