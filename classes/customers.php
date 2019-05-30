<?php
/**
 * The customer class represents a customer in website.
 *
 * The customer class represents a customer with a name, address,phone,
 * email,state, zip code,and property type.
 * @author Sukhveer S Jawandha <sjawandha2@mail.greenriver.edu>
 * @copyright 2019
 */

class customer
{
    private $name;
    private $_email;
    private $_phone;
    private $_address;
    private $_zip;
    private $_state;
    private $_type;


    // Define parameterized constructor
    function __construct($name, $email, $phone, $state, $type)
    {
        $this->_name = $name;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_state = $state;
        $this->_type = $type;
    }

    /**
     * Get  name of the customer
     * @return String $name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Set the  name of customer
     * @param $name name of member
     * @return void
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Get the email of customer
     * @return String $email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set the email of customer
     * @param String $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Get the phone number of customer
     * @return String $phone Phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Set the phone number of customer
     * @param $phone The phone number
     * @return void
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Get the address  of customer
     * @return String $address
     */
    public function getAddress()
    {
        return $this->_address;
    }

    /**
     * Set the address of customer
     * @param $address address of customer
     * @return void
     */
    public function setAddress($address)
    {
        $this->_address = $address;
    }

    /**
     * Get the zip  of customer
     * @return String $zip
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * Set the zip code of customer
     * @param $zip zip code of customer
     * @return void
     */
    public function setZip($zip)
    {
        $this->_zip = $zip;
    }

    /**
     * Get the state of customer
     * @return String State
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set the state of customer
     * @param String $state
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Get the property type of customers
     * @return String $type
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Set the property type of customer
     * @param String $type property type of customer
     * @return void
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

}