<?php

namespace Aplazame\BusinessModel;

/**
 * Checkout.
 */
class Checkout extends AbstractModel
{
    /**
     * @var null|bool
     */
    public $toc;

    /**
     * @var null|Merchant
     */
    public $merchant;

    /**
     * @var null|Order
     */
    public $order;

    /**
     * @var null|Customer
     */
    public $customer;

    /**
     * @var null|Address
     */
    public $billing;

    /**
     * @var null|ShippingInfo
     */
    public $shipping;

    /**
     * @var array
     */
    public $meta = array();
}
