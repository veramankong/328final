<?php
/**
 * The premium member class represents a member as a premium member in dating website.
 *
 * The member class represents a member as a premium member  with a name, age,gender,phone,
 * email,state,seeking,bio, and interests.
 * @author Sukhveer S Jawandha <sjawandha2@mail.greenriver.edu>
 * @copyright 2019
 */


class residential extends customer
{
    private $_services;
    private $_additional_services;

    /**
     * residential constructor
     * @param $first string customer first name
     * @param $last string customer last name
     * @param $email string customer email
     * @param $phone int customer phone number
     * @param $state string customer statte
     * @param $type string customer type
     */
    function __construct($first,$last, $email, $phone, $state, $type)
    {
        // parent constructor call
        parent::__construct($first,$last, $phone, $email, $state, $type);
    }

    /**
     * @return array
     */
    public function getServices()
    {
        return $this->_services;
    }

    /**
     * @param mixed $services
     */
    public function setServices($services)
    {
        $this->_services = $services;
    }

    /**
     * @return mixed
     */
    public function getAdditionalServices()
    {
        return $this->_additional_services;
    }

    /**
     * @param mixed $residential_services
     */
    public function setAdditionalServices($residential_services)
    {
        $this->_additional_services = $residential_services;
    }
}
