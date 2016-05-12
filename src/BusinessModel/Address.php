<?php

namespace Aplazame\BusinessModel;

class Address extends AbstractModel
{
    /**
     * First name.
     *
     * @var string
     */
    public $first_name;

    /**
     * Last name.
     *
     * @var string
     */
    public $last_name;

    /**
     * Phone number.
     *
     * @var null|string
     */
    public $phone;

    /**
     * Alternative number.
     *
     * @var null|string
     */
    public $alt_phone;

    /**
     * Street.
     *
     * @var string
     */
    public $street;

    /**
     * Address addition.
     *
     * @var null|string
     */
    public $address_addition;

    /**
     * City.
     *
     * @var string
     */
    public $city;

    /**
     * State.
     *
     * @var string
     */
    public $state;

    /**
     * Country code.
     *
     * @var string
     */
    public $country;

    /**
     * postcode.
     *
     * @var string
     */
    public $postcode;

    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $street
     * @param string $city
     * @param string $state
     * @param string $country
     * @param string $postcode
     */
    public function __construct($first_name, $last_name, $street, $city, $state, $country, $postcode)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
        $this->postcode = $postcode;
    }
}
