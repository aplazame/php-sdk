<?php

namespace Aplazame\BusinessModel;

use PHPUnit_Framework_TestCase as TestCase;

abstract class AbstractModelTestCase extends TestCase
{
    public function mockClassAndJsonSerialize($class, $jsonSerialize)
    {
        // @codingStandardsIgnoreStart
        $mock = $this->getMockBuilder($class)->disableOriginalConstructor()->getMock();
        $mock->method('jsonSerialize')->willReturn($jsonSerialize);
        // @codingStandardsIgnoreEnd

        return $mock;
    }
}
