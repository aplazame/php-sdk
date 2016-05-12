<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Address
 */
class AddressTest extends AbstractModelTestCase
{
    public function testMinimalFields()
    {
        $address = new Address(
            'first name foo',
            'last name foo',
            'street foo',
            'city foo',
            'state foo',
            'ES',
            '10001'
        );

        $expected = <<<JSON
{
    "first_name": "first name foo",
    "last_name": "last name foo",
    "street": "street foo",
    "city": "city foo",
    "state": "state foo",
    "country": "ES",
    "postcode": "10001"
}
JSON;

        self::assertEquals(json_decode($expected, true), $address->jsonSerialize());
    }

    public function testAllFields()
    {
        $address = new Address(
            'first name foo',
            'last name foo',
            'street foo',
            'city foo',
            'state foo',
            'ES',
            '10001'
        );
        $address->phone = '0099123456789';
        $address->alt_phone = '+99123456789';
        $address->address_addition = 'address_addition foo';

        $expected = <<<JSON
{
    "first_name": "first name foo",
    "last_name": "last name foo",
    "street": "street foo",
    "city": "city foo",
    "state": "state foo",
    "country": "ES",
    "postcode": "10001",
    "phone": "0099123456789",
    "alt_phone": "+99123456789",
    "address_addition": "address_addition foo"
}
JSON;

        self::assertEquals(json_decode($expected, true), $address->jsonSerialize());
    }
}
