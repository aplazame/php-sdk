<?php

namespace Aplazame\Api;

use PHPUnit\Framework\TestCase;

/**
 * @covers Aplazame\Api\ApiRequest
 */
class ApiRequestTest extends TestCase
{
    /**
     * @dataProvider acceptHeaderProvider
     */
    public function testCreateAcceptHeader($useSandbox, $apiVersion, $format, $expectedHeader)
    {
        $header = ApiRequest::createAcceptHeader($useSandbox, $apiVersion, $format);

        self::assertEquals($expectedHeader, $header);
    }

    public function acceptHeaderProvider()
    {
        return array(
            // Description => [useSandbox, apiVersion, format, expectedHeader]
            'with sandbox' => array(true, 1, 'json', 'application/vnd.aplazame.sandbox.v1+json'),
            'without sandbox' => array(false, 1, 'json', 'application/vnd.aplazame.v1+json'),
            'xml' => array(false, 1, 'xml', 'application/vnd.aplazame.v1+xml'),
            'yaml' => array(false, 1, 'yaml', 'application/vnd.aplazame.v1+yaml'),
        );
    }

    /**
     * @dataProvider authorizationHeaderProvider
     */
    public function testCreateAuthorizationHeader($accessToken, $expectedHeader)
    {
        $header = ApiRequest::createAuthorizationHeader($accessToken);

        self::assertEquals($expectedHeader, $header);
    }

    public function authorizationHeaderProvider()
    {
        return array(
            // Description => [accessToken, expectedHeader]
            'foo' => array('foo', 'Bearer foo'),
        );
    }

    /**
     * @dataProvider constructorProvider
     */
    public function testConstructor($useSandbox, $accessToken, $expectedHeaders)
    {
        $helper = new ApiRequest($useSandbox, $accessToken, 'GET', 'http://api.example.com');

        self::assertEquals($expectedHeaders, $helper->getHeaders(), 'getHeaders not match');
    }

    public function constructorProvider()
    {
        return array(
            // Description => [useSandbox, accessToken, expectedHeader]
            'foo' => array(
                'useSandbox' => true,
                'accessToken' => 'foo',
                'expectedHeaders' => array(
                    'Accept' => array('application/vnd.aplazame.sandbox.v1+json'),
                    'Authorization' => array('Bearer foo'),
                    'User-Agent' => array(
                        'Aplazame/' . ApiRequest::SDK_VERSION,
                        'PHP/' . PHP_VERSION,
                    ),
                ),
            ),
        );
    }
}
