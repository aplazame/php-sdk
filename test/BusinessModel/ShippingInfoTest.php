<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\ShippingInfo
 */
class ShippingInfoTest extends AddressTest
{
    public function testMinimalFields()
    {
        $shippingInfo = new ShippingInfo(
            'first name foo',
            'last name foo',
            'street foo',
            'city foo',
            'state foo',
            'ES',
            '10001',
            'name foo',
            Decimal::fromFloat(1)
        );

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
    "price": 100
}
JSON;

        self::assertEquals(json_decode($expected, true), $shippingInfo->jsonSerialize());
    }

    public function testAllFields()
    {
        $shippingInfo = new ShippingInfo(
            'first name foo',
            'last name foo',
            'street foo',
            'city foo',
            'state foo',
            'ES',
            '10001',
            'name foo',
            Decimal::fromFloat(1)
        );
        $shippingInfo->phone = '0099123456789';
        $shippingInfo->alt_phone = '+99123456789';
        $shippingInfo->address_addition = 'address_addition foo';
        $shippingInfo->tax_rate = Decimal::fromFloat(2);
        $shippingInfo->discount = Decimal::fromFloat(3);
        $shippingInfo->discount_rate = Decimal::fromFloat(3);

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
    "discount_rate": 300
}
JSON;

        self::assertEquals(json_decode($expected, true), $shippingInfo->jsonSerialize());
    }
}
