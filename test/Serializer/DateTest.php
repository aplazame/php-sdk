<?php

namespace Aplazame\Serializer;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @covers Aplazame\Serializer\Date
 */
class DateTest extends TestCase
{
    public function testJsonSerialize()
    {
        $date = new Date('123');

        self::assertSame('123', $date->jsonSerialize());
    }

    /**
     * @dataProvider valuesProvider
     */
    public function testConversion($dateTime, $string)
    {
        $date = Date::fromDateTime($dateTime);

        self::assertSame($string, $date->value, 'string value not match');
        self::assertEquals($dateTime, $date->asDateTime(), 'datetime value not match');
    }

    public function valuesProvider()
    {
        return array(
            // Description => [DateTime, string]
            '1999-12-31' => array(new \DateTime('1999-12-31'), '1999-12-31T00:00:00+0100'),
            '1999-12-31 23:59:59' => array(new \DateTime('1999-12-31 23:59:59'), '1999-12-31T23:59:59+0100'),
        );
    }
}
