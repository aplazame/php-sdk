<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Address
 */
class AddressTest extends AbstractModelTestCase
{
    public function testAllFields()
    {
        $address = new Address();
        $address->first_name = 'first name foo';
        $address->last_name = 'last name foo';
        $address->street = 'street foo';
        $address->city = 'city foo';
        $address->state = 'state foo';
        $address->country = 'ES';
        $address->postcode = '10001';
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
