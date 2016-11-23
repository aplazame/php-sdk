<?php

namespace Aplazame\Serializer;

/**
 * Decimal Type.
 */
class Decimal implements JsonSerializable
{
    public static function fromFloat($value)
    {
        return new self((int) number_format($value, 2, '', ''));
    }

    /**
     * @var null|int
     */
    public $value;

    /**
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function asFloat()
    {
        return $this->value / 100;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
