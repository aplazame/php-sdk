<?php

namespace Aplazame\BusinessModel;

use DateTime;

/**
 * This class is used for DRY pattern for PHP versions below to PHP 5.4.
 */
abstract class AbstractModel
{
    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by json_encode(), which is a value of any type other than a resource.
     *
     * @codeCoverageIgnore
     */
    public function jsonSerialize()
    {
        $model = get_object_vars($this);
        foreach ($model as $field => &$value) {
            if ($value === null) {
                unset($model[$field]);

                continue;
            }

            $value = $this->jsonSerializeValue($value);
        }

        return $model;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     *
     * @codeCoverageIgnore
     */
    private function jsonSerializeValue($value)
    {
        if ($value instanceof self) {
            return $value->jsonSerialize();
        }

        if (is_array($value)) {
            foreach ($value as &$nestedValue) {
                $nestedValue = $this->jsonSerializeValue($nestedValue);
            }

            return $value;
        }

        if ($value instanceof DateTime) {
            return $value->format(DateTime::ISO8601);
        }

        return $value;
    }
}
