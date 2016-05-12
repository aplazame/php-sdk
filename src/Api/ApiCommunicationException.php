<?php

namespace Aplazame\Api;

use Exception;
use RuntimeException;

/**
 * Exception thrown when there is communication possible with the API.
 */
class ApiCommunicationException extends RuntimeException implements AplazameExceptionInterface
{
    /**
     * @param Exception $exception
     *
     * @return self
     */
    public static function fromException(Exception $exception)
    {
        return new self($exception->getMessage(), $exception->getCode(), $exception);
    }
}
