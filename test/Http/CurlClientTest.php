<?php

namespace Aplazame\Http;

/**
 * @covers \Aplazame\Http\CurlClient
 *
 * @requires extension curl
 */
class CurlClientTest extends AbstractClientTestCase
{
    protected function createClient()
    {
        return new CurlClient();
    }
}
