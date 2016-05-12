<?php

namespace Aplazame\Api;

use Aplazame\Http\ResponseInterface;
use LogicException;

/**
 * Exception thrown for HTTP 4xx client errors.
 */
class ApiClientException extends LogicException implements AplazameExceptionInterface
{
    /**
     * @param ResponseInterface $response
     *
     * @return self
     */
    public static function fromResponse(ResponseInterface $response)
    {
        $responseBody = (string) $response->getBody();
        if (empty($responseBody)) {
            return new self($response->getReasonPhrase(), $response->getStatusCode());
        }

        $decodedBody = json_decode($responseBody, true);
        if (!isset($decodedBody['error'])) {
            return new self($response->getReasonPhrase(), $response->getStatusCode());
        }

        $error = $decodedBody['error'];

        return new self($error['type'], $error['message'], $error);
    }

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $error;

    /**
     * @param string $type
     * @param string $message
     * @param array $error
     */
    public function __construct($type, $message, array $error = array())
    {
        parent::__construct($message);

        $this->type = $type;
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }
}
