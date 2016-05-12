<?php

namespace Aplazame\Http;

use PHPUnit_Framework_TestCase as TestCase;

abstract class AbstractClientTestCase extends TestCase
{
    public function testImplementsClientInterface()
    {
        $client = $this->createClient();

        self::assertInstanceOf('Aplazame\\Http\\ClientInterface', $client);
    }

    /**
     * @dataProvider requestProvider
     */
    public function testSend(RequestInterface $request)
    {
        $client = $this->createClient();

        $response = $client->send($request);

        self::assertInstanceOf('Aplazame\\Http\\ResponseInterface', $response);

        $responseBody = json_decode($response->getBody(), true);

        self::assertEquals($request->getUri(), $responseBody['url']);
        self::assertArrayHasKey('X-Foo', $responseBody['headers']);
        self::assertEquals('fooValue', $responseBody['headers']['X-Foo']);
        $body = $request->getBody();
        if ($body) {
            self::assertArrayHasKey($body, $responseBody['form']);
        }
    }

    /**
     * @dataProvider requestWithoutResponseBodyProvider
     */
    public function testRequestWithoutResponseBody(RequestInterface $request, $statusCode)
    {
        $client = $this->createClient();

        $response = $client->send($request);

        self::assertInstanceOf('Aplazame\\Http\\ResponseInterface', $response);

        self::assertEquals($statusCode, $response->getStatusCode());
    }

    /**
     * @dataProvider invalidRequestProvider
     */
    public function testSendThrowException(RequestInterface $request, $exceptionClass)
    {
        $client = $this->createClient();

        $this->setExpectedException($exceptionClass);

        $client->send($request);
    }

    public function requestProvider()
    {
        $headers = array('X-Foo' => array('fooValue'));
        $testBody = 'testBody';

        return array(
            // Description => [request]
            'delete' => array(new Request('delete', 'http://httpbin.org/delete', $headers)),
            'get' => array(new Request('get', 'http://httpbin.org/get', $headers)),
            'patch' => array(new Request('patch', 'http://httpbin.org/patch', $headers, $testBody)),
            'post' => array(new Request('post', 'http://httpbin.org/post', $headers, $testBody)),
            'put' => array(new Request('put', 'http://httpbin.org/put', $headers, $testBody)),
        );
    }

    public function requestWithoutResponseBodyProvider()
    {
        return array(
            // Description => [request, status code]
            '500' => array(new Request('get', 'http://httpbin.org/status/500'), 500),
        );
    }

    public function invalidRequestProvider()
    {
        $runtimeException = 'RuntimeException';

        return array(
            // Description => [request, exceptionClass]
            'Bad host' => array(new Request('get', 'http://notexists'), $runtimeException),
        );
    }

    /**
     * @return ClientInterface
     */
    abstract protected function createClient();
}
