<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Order
 */
class OrderTest extends AbstractModelTestCase
{
    public function testAllFields()
    {
        $order = new Order();
        $order->id = 'id1234';
        $order->currency = 'EUR';
        $order->tax_rate = Decimal::fromFloat(1);
        $order->total_amount = Decimal::fromFloat(2);
        $order->articles = array(
            $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Article', 'Article model'),
        );
        $order->discount = Decimal::fromFloat(3);
        $order->discount_rate = Decimal::fromFloat(4);
        $order->cart_discount = Decimal::fromFloat(5);
        $order->cart_discount_rate = Decimal::fromFloat(6);

        $expected = <<<JSON
{
  "id": "id1234",
  "currency": "EUR",
  "tax_rate": 100,
  "total_amount": 200,
  "articles": [
    "Article model"
  ],
  "discount": 300,
  "discount_rate": 400,
  "cart_discount": 500,
  "cart_discount_rate": 600
}
JSON;

        self::assertEquals(json_decode($expected, true), $order->jsonSerialize());
    }
}
