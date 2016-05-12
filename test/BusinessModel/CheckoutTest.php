<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Checkout
 */
class CheckoutTest extends AbstractModelTestCase
{
    public function testMinimalFields()
    {
        $checkout = new Checkout(
            true,
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Merchant', 'Merchant model'),
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Order', 'Order model'),
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Customer', 'Customer model')
        );

        $expected = <<<JSON
{
    "toc": true,
    "merchant": "Merchant model",
    "order": "Order model",
    "customer": "Customer model",
    "meta": []
}
JSON;

        self::assertEquals(json_decode($expected, true), $checkout->jsonSerialize());
    }

    public function testAllFields()
    {
        $checkout = new Checkout(
            true,
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Merchant', 'Merchant model'),
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Order', 'Order model'),
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Customer', 'Customer model')
        );
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
