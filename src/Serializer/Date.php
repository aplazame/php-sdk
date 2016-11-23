<?php

namespace Aplazame\Serializer;

use DateTime;

/**
 * DateTime Type.
 */
class Date implements JsonSerializable
{
    /**
     * @param DateTime $value
     *
     * @return self
     */
    public static function fromDateTime($value)
    {
        return new self($value->format(DateTime::ISO8601));
    }

    /**
     * @var null|string
     */
    public $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return DateTime
     */
    public function asDateTime()
    {
        $dateTime = DateTime::createFromFormat(DateTime::ISO8601, $this->value);

        return $dateTime;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}
