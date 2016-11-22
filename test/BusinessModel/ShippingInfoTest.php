<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\ShippingInfo
 */
class ShippingInfoTest extends AddressTest
{
    public function testAllFields()
    {
        $shippingInfo = new ShippingInfo();
        $shippingInfo->first_name = 'first name foo';
        $shippingInfo->last_name = 'last name foo';
        $shippingInfo->street = 'street foo';
        $shippingInfo->city = 'city foo';
        $shippingInfo->state = 'state foo';
        $shippingInfo->country = 'ES';
        $shippingInfo->postcode = '10001';
        $shippingInfo->name = 'name foo';
        $shippingInfo->price = Decimal::fromFloat(1);
        $shippingInfo->phone = '0099123456789';
        $shippingInfo->alt_phone = '+99123456789';
        $shippingInfo->address_addition = 'address_addition foo';
        $shippingInfo->tax_rate = Decimal::fromFloat(2);
        $shippingInfo->discount = Decimal::fromFloat(3);
        $shippingInfo->discount_rate = Decimal::fromFloat(4);

        $expected = <<<JSON
{
    "first_name": "first name foo",
    "last_name": "last name foo",
    "street": "street foo",
    "city": "city foo",
    "state": "state foo",
    "country": "ES",
    "postcode": "10001",
    "name": "name foo",
    "price": 100,
    "phone": "0099123456789",
    "alt_phone": "+99123456789",
    "address_addition": "address_addition foo",
    "tax_rate": 200,
    "discount": 300,
    "discount_rate": 400
}
JSON;

        self::assertEquals(json_decode($expected, true), $shippingInfo->jsonSerialize());
    }
}
