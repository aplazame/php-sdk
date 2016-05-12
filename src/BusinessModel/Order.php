<?php

namespace Aplazame\BusinessModel;

use InvalidArgumentException;

/**
 * Order.
 */
class Order extends AbstractModel
{
    /**
     * Your order ID.
     *
     * @var string
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
     * @var string
     */
    public $currency;

    /**
     * Order tax rate.
     *
     * @var Decimal
     */
    public $tax_rate;

    /**
     * Order total amount.
     *
     * @var Decimal
     */
    public $total_amount;

    /**
     * Articles in cart.
     *
     * @var Article[]
     */
    public $articles;

    /**
     * @param string $id
     * @param string $currency
     * @param Decimal $tax_rate
     * @param Decimal $total_amount
     * @param Article[] $articles
     */
    public function __construct($id, $currency, Decimal $tax_rate, Decimal $total_amount, array $articles)
    {
        if (empty($articles)) {
            throw new InvalidArgumentException('$articles must not to be empty');
        }

        $this->id = $id;
        $this->currency = $currency;
        $this->tax_rate = $tax_rate;
        $this->total_amount = $total_amount;
        $this->articles = $articles;
    }
}
