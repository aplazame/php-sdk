<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Checkout
 */
class CheckoutTest extends AbstractModelTestCase
{
    public function testAllFields()
    {
        $checkout = new Checkout();
        $checkout->toc = true;
        $checkout->merchant = $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Merchant', 'Merchant model');
        $checkout->order = $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Order', 'Order model');
        $checkout->customer = $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Customer', 'Customer model');
        $checkout->shipping = $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\ShippingInfo', 'ShippingInfo model');
        $checkout->billing = $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Address', 'Address model');
        $checkout->meta = array('foo' => 'baz');

        $expected = <<<JSON
{
    "toc": true,
    "merchant": "Merchant model",
    "order": "Order model",
    "customer": "Customer model",
    "billing": "Address model",
    "shipping": "ShippingInfo model",
    "meta": {
      "foo": "baz"    
    }
}
JSON;

        self::assertEquals(json_decode($expected, true), $checkout->jsonSerialize());
    }
}
