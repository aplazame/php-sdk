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
     * @var string
     */
    public $confirmation_url;

    /**
     * url that the customer is sent to if there is an error in the checkout.
     *
     * @var string
     */
    public $cancel_url;

    /**
     * url that the customer is sent to after confirming their order.
     *
     * @var string
     */
    public $success_url;

    /**
     * url that the customer is sent to if the customer chooses to back to the e-commerce, by default is /.
     *
     * @var string
     */
    public $checkout_url = '/';

    /**
     * @param string $confirmation_url
     * @param string $cancel_url
     * @param string $success_url
     */
    public function __construct($confirmation_url, $cancel_url, $success_url)
    {
        $this->confirmation_url = $confirmation_url;
        $this->cancel_url = $cancel_url;
        $this->success_url = $success_url;
    }
}
