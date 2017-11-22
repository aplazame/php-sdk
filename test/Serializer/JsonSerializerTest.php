<?php

namespace Aplazame\Serializer;

use DateTime;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @covers Aplazame\Serializer\Decimal
 */
class JsonSerializerTest extends TestCase
{
    /**
     * @dataProvider valuesProvider
     */
    public function testSerializeValue($value, $serialized)
    {
        self::assertEquals($serialized, json_encode(JsonSerializer::serializeValue($value)));
    }

    public function valuesProvider()
    {
        $date = Date::fromDateTime(new DateTime('2000-01-02 03:04:05'));
        $decimal = Decimal::fromFloat(1.23);

        return array(
            // Description => [value, serialized]
            'string' => array('foo', '"foo"'),
            '[string]' => array(array('foo'), '["foo"]'),
            '{string}' => array((object) array('a' => 'foo'), '{"a":"foo"}'),
            'int' => array(1, 1),
            '[int]' => array(array(1), '[1]'),
            '{int}' => array((object) array('a' => 1), '{"a":1}'),
            // 'float' is omitted as this type is forbidden
            'Decimal' => array($decimal, '123'),
            '[Decimal]' => array(array($decimal), '[123]'),
            '{Decimal}' => array((object) array('a' => $decimal), '{"a":123}'),
            'true' => array(true, 'true'),
            '[true]' => array(array(true), '[true]'),
            '{true}' => array((object) array('a' => true), '{"a":true}'),
            'false' => array(false, 'false'),
            '[false]' => array(array(false), '[false]'),
            '{false}' => array((object) array('a' => false), '{"a":false}'),
            // 'DateTime' is omitted as this type is forbidden
            'Date' => array($date, '"2000-01-02T03:04:05+0100"'),
            '[Date]' => array(array($date), '["2000-01-02T03:04:05+0100"]'),
            '{Date}' => array((object) array('a' => $date), '{"a":"2000-01-02T03:04:05+0100"}'),
            '{}' => array((object) new \stdClass(), '{}'),
            '[]' => array(array(), '[]'),
        );
    }
}
