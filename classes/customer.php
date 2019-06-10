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
    private $_first;
    private $_last;
    private $_email;
    private $_phone;
    private $_address;
    private $_zip;
    private $_state;
    private $_type;

    /**
     * customer constructor
     * @param $first string customer first name
     * @param $last string customer last name
     * @param $email string customer email
     * @param $phone int customer phone number
     * @param $state string customer statte
     * @param $type string customer type
     */
    function __construct($first,$last, $email, $phone, $state, $type)
    {
        $this->_first = $first;
        $this->_last = $last;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_state = $state;
        $this->_type = $type;
    }

    /**
     * Get  first name of the customer
     * @return String $first
     */
    public function getFirst()
    {
        return $this->_first;
    }


    /**
     * Set the  first name of customer
     * @param String $first first name of member
     * @return void
     */
    public function setFirst($first)
    {
        $this->_first = $first;
    }

    /**
     * Get  last name of the customer
     * @return String $last
     */
    public function getLast()
    {
        return $this->_last;
    }

    /**
     * Set the  last name of customer
     * @param String $last last name of member
     * @return void
     */
    public function setLast($last)
    {
        $this->_last = $last;
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