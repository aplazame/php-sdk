<?php

namespace Aplazame\BusinessModel;

/**
 * Checkout.
 */
class Checkout extends AbstractModel
{
    /**
     * @var bool
     */
    public $toc;

    /**
     * @var Merchant
     */
    public $merchant;

    /**
     * @var Order
     */
    public $order;

    /**
     * @var Customer
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

    /**
     * @param bool $toc
     * @param Merchant $merchant
     * @param Order $order
     * @param Customer $customer
     */
    public function __construct(
        $toc,
        Merchant $merchant,
        Order $order,
        Customer $customer
    ) {
        $this->toc = $toc;
        $this->merchant = $merchant;
        $this->order = $order;
        $this->customer = $customer;
    }
}
