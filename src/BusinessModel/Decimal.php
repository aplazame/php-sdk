<?php

namespace Aplazame\BusinessModel;

/**
 * Decimal Type.
 */
class Decimal extends AbstractModel
{
    public static function fromFloat($value)
    {
        return new self((int) number_format($value, 2, '', ''));
    }

    /**
     * @var int
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
