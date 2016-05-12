<?php

namespace Aplazame\BusinessModel;

/**
 * @covers Aplazame\BusinessModel\Merchant
 */
class MerchantTest extends AbstractModelTestCase
{
    public function testMinimalFields()
    {
        $merchant = new Merchant(
            'http://confirmation_url.foo',
            'http://cancel_url.foo',
            'http://success_url.foo'
        );

        $expected = <<<JSON
{
  "confirmation_url": "http://confirmation_url.foo",
  "cancel_url": "http://cancel_url.foo",
  "success_url": "http://success_url.foo",
  "checkout_url": "/"
}
JSON;

        self::assertEquals(json_decode($expected, true), $merchant->jsonSerialize());
    }

    public function testAllFields()
    {
        $merchant = new Merchant(
            'http://confirmation_url.foo',
            'http://cancel_url.foo',
            'http://success_url.foo'
        );
        $merchant->checkout_url = 'http://checkout_url.foo';

        $expected = <<<JSON
{
  "confirmation_url": "http://confirmation_url.foo",
  "cancel_url": "http://cancel_url.foo",
  "success_url": "http://success_url.foo",
  "checkout_url": "http://checkout_url.foo"
}
JSON;

        self::assertEquals(json_decode($expected, true), $merchant->jsonSerialize());
    }
}
