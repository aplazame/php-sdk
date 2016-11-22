<?php

namespace Aplazame\BusinessModel;

/**
 * Merchant.
 */
class Merchant extends AbstractModel
{
    /**
     * url that the JS client sent to confirming the order.
     *
     * @var null|string
     */
    public $confirmation_url;

    /**
     * url that the customer is sent to if there is an error in the checkout.
     *
     * @var null|string
     */
    public $cancel_url;

    /**
     * url that the customer is sent to after confirming their order.
     *
     * @var null|string
     */
    public $success_url;

    /**
     * url that the customer is sent to if the customer chooses to back to the e-commerce, by default is /.
     *
     * @var null|string
     */
    public $checkout_url;
}
