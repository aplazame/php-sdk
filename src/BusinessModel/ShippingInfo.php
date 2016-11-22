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
     * @var null|string
     */
    public $name;

    /**
     * Shipping price (tax is not included).
     *
     * @var null|Decimal
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
}
