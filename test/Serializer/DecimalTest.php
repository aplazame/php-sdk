<?php

namespace Aplazame\Serializer;

use PHPUnit\Framework\TestCase;

/**
 * @covers Aplazame\Serializer\Decimal
 */
class DecimalTest extends TestCase
{
    public function testJsonSerialize()
    {
        $decimal = new Decimal('123');

        self::assertSame('123', $decimal->jsonSerialize());
    }

    /**
     * @dataProvider valuesProvider
     */
    public function testConversion($float, $int)
    {
        $decimal = Decimal::fromFloat($float);

        self::assertSame($int, $decimal->value, 'int value not match');
        self::assertSame($float, $decimal->asFloat(), 'float value not match');
    }

    public function valuesProvider()
    {
        return array(
            // Description => [float, int]
            '0' => array(0, 0),
            '0.1' => array(0.1, 10),
            '0.01' => array(0.01, 1),
            '1' => array(1, 100),
            '1.10' => array(1.10, 110),
            '1.01' => array(1.01, 101),
            '100' => array(100, 10000),
            '100.10' => array(100.10, 10010),
            '100.01' => array(100.01, 10001),
        );
    }
}
