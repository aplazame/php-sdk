<?php

namespace Aplazame\Serializer;

use DateTime;
use DomainException;

/**
 * This class assist to compose API models serializable as JSON for PHP versions prior to v5.4.
 */
class JsonSerializer
{
    /**
     * Important: This method does not return a JSON string, the return of this method must be encoded with `json_encode()`.
     *
     * @param mixed $value
     *
     * @return mixed a value valid for to be used with native `json_encode()` function
     */
    public static function serializeValue($value)
    {
        if ($value instanceof JsonSerializable || $value instanceof \JsonSerializable) {
            return $value->jsonSerialize();
        }

        if (is_object($value)) {
            foreach (get_object_vars($value) as $nestedKey => $nestedValue) {
                $value->{$nestedKey} = self::serializeValue($nestedValue);
            }
        } elseif (is_array($value)) {
            foreach ($value as &$nestedValue) {
                $nestedValue = self::serializeValue($nestedValue);
            }

            return $value;
        }

        if ($value instanceof DateTime || $value instanceof \DateTimeInterface) {
            throw new DomainException('Please wrap your DateTime objects with Aplazame\Serializer\Date::fromDateTime');
        }

        if (is_float($value)) {
            throw new DomainException('Please wrap your float values with Aplazame\Serializer\Decimal::fromFloat');
        }

        return $value;
    }
}
