<?php

namespace Aplazame\BusinessModel;

/**
 * Order.
 */
class Order extends AbstractModel
{
    /**
     * Your order ID.
     *
     * @var null|string
     */
    public $id;

    /**
     * The discount amount of the order.
     *
     * @var null|Decimal
     */
    public $discount;

    /**
     * The rate discount of the order.
     *
     * @var null|Decimal
     */
    public $discount_rate;

    /**
     * The discount amount of the cart.
     *
     * @var null|Decimal
     */
    public $cart_discount;

    /**
     * The rate discount of the cart.
     *
     * @var null|Decimal
     */
    public $cart_discount_rate;

    /**
     * Currency code of the order.
     *
     * @var null|string
     */
    public $currency;

    /**
     * Order tax rate.
     *
     * @var null|Decimal
     */
    public $tax_rate;

    /**
     * Order total amount.
     *
     * @var null|Decimal
     */
    public $total_amount;

    /**
     * Articles in cart.
     *
     * @var Article[]
     */
    public $articles = array();
}
