<?php

namespace Aplazame\BusinessModel;

use DateTime;
use DateTimeZone;

/**
 * @covers Aplazame\BusinessModel\Customer
 */
class CustomerTest extends AbstractModelTestCase
{
    public function testMinimalFields()
    {
        $customer = new Customer(
            'id1234',
            'foo@example.com',
            Customer::TYPE_NEW,
            Customer::GENDER_UNKNOWN
        );

        $expected = <<<JSON
{
  "id": "id1234",
  "email": "foo@example.com",
  "type": "n",
  "gender": 0
}
JSON;

        self::assertEquals(json_decode($expected, true), $customer->jsonSerialize());
    }

    public function testAllFields()
    {
        $customer = new Customer(
            'id1234',
            'foo@example.com',
            Customer::TYPE_NEW,
            Customer::GENDER_UNKNOWN
        );
        $customer->first_name = 'description lorem ipsum';
        $customer->last_name = 'last name';
        $customer->birthday = new DateTime('2000-12-31 23:59:59', new DateTimeZone('UTC'));
        $customer->language = 'de';
        $customer->date_joined = new DateTime('2001-12-31 23:59:59', new DateTimeZone('Europe/Berlin'));
        $customer->last_login = new DateTime('2002-12-31 23:59:59', new DateTimeZone('America/Los_Angeles'));
        $customer->address = $this->mockClassAndJsonSerialize('Aplazame\\BusinessModel\\Address', 'Address model');

        $expected = <<<JSON
{
  "id": "id1234",
  "email": "foo@example.com",
  "type": "n",
  "gender": 0,
  "first_name": "description lorem ipsum",
  "last_name": "last name",
  "birthday": "2000-12-31T23:59:59+0000",
  "language": "de",
  "date_joined": "2001-12-31T23:59:59+0100",
  "last_login": "2002-12-31T23:59:59-0800",
  "address": "Address model"
}
JSON;

        self::assertEquals(json_decode($expected, true), $customer->jsonSerialize());
    }
}
