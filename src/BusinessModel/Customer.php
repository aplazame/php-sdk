<?php

namespace Aplazame\BusinessModel;

use DateTime;

/**
 * Customer.
 */
class Customer extends AbstractModel
{
    const TYPE_EXISTING = 'e';
    const TYPE_GUEST = 'g';
    const TYPE_NEW = 'n';

    const GENDER_UNKNOWN = 0;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_NOT_APPLICABLE = 3;

    /**
     * Customer ID.
     *
     * @var null|string
     */
    public $id;

    /**
     * The customer email.
     *
     * @var null|string
     */
    public $email;

    /**
     * Customer type, the choices are g:guest, n:new, e:existing.
     *
     * @see Customer::TYPE_EXISTING
     * @see Customer::TYPE_GUEST
     * @see Customer::TYPE_NEW
     *
     * @var null|string
     */
    public $type;

    /**
     * Customer gender, the choices are 0: not known, 1: male, 2:female, 3: not applicable.
     *
     * @var null|int
     */
    public $gender;

    /**
     * Customer first name.
     *
     * @var null|string
     */
    public $first_name;

    /**
     * Customer last name.
     *
     * @var null|string
     */
    public $last_name;

    /**
     * Customer birthday.
     *
     * @var null|DateTime
     */
    public $birthday;

    /**
     * Customer language preferences.
     *
     * @var null|string
     */
    public $language;

    /**
     * A datetime designating when the customer account was created.
     *
     * @var null|DateTime
     */
    public $date_joined;

    /**
     * A datetime of the customer last login.
     *
     * @var null|DateTime
     */
    public $last_login;

    /**
     * Customer address.
     *
     * @var null|Address
     */
    public $address;
}
