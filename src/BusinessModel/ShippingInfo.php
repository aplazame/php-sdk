<?php

namespace Aplazame\BusinessModel;

/**
 * Shipping info.
 */
class ShippingInfo extends Address
{
    /**
     * Name.
     *
     * @var string
     */
    public $name;

    /**
     * Shipping price (tax is not included).
     *
     * @var Decimal
     */
    public $price;

    /**
     * Shipping tax_rate.
     *
     * @var null|Decimal
     */
    public $tax_rate;

    /**
     * The discount amount of the article.
     *
     * @var null|Decimal
     */
    public $discount;

    /**
     * The rate discount of the article.
     *
     * @var null|Decimal
     */
    public $discount_rate;

    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $street
     * @param string $city
     * @param string $state
     * @param string $country
     * @param string $postcode
     * @param string $name
     * @param Decimal $price
     */
    public function __construct($first_name, $last_name, $street, $city, $state, $country, $postcode, $name, Decimal $price)
    {
        parent::__construct($first_name, $last_name, $street, $city, $state, $country, $postcode);

        $this->name = $name;
        $this->price = $price;
    }
}
