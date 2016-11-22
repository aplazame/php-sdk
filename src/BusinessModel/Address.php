<?php

namespace Aplazame\BusinessModel;

class Address extends AbstractModel
{
    /**
     * First name.
     *
     * @var null|string
     */
    public $first_name;

    /**
     * Last name.
     *
     * @var null|string
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
     * @var null|string
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
     * @var null|string
     */
    public $city;

    /**
     * State.
     *
     * @var null|string
     */
    public $state;

    /**
     * Country code.
     *
     * @var null|string
     */
    public $country;

    /**
     * postcode.
     *
     * @var null|string
     */
    public $postcode;
}
