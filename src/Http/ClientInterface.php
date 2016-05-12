<?php

namespace Aplazame\Http;

use RuntimeException;

interface ClientInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws RuntimeException If requests cannot be performed due network issues.
     */
    public function send(RequestInterface $request);
}
