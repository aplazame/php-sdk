<?php

namespace Aplazame\Api;

use Aplazame\Http\Response;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @covers Aplazame\Api\Client
 */
class ClientTest extends TestCase
{
    public function testSuccessRequest()
    {
        $httpClient = $this->getMock('Aplazame\\Http\\ClientInterface');
        $httpClient->method('send')
            ->willReturn(new Response(200, '{"foo": "value"}'))
        ;

        $client = new Client(
            'http://api.example.com',
            Client::ENVIRONMENT_SANDBOX,
            'fooAccessToken',
            $httpClient
        );

        $response = $client->request('get', 'uri');

        self::assertEquals(array('foo' => 'value'), $response);
    }

    /**
     * @dataProvider wrongResponseProvider
     */
    public function testSendRequestThrowException($httpClientCallable, $exception)
    {
        $client = new Client(
            'http://api.example.com',
            Client::ENVIRONMENT_SANDBOX,
            'fooAccessToken',
            $httpClientCallable()
        );

        $this->setExpectedException($exception);

        $client->request('get', 'uri');
    }

    public function wrongResponseProvider()
    {
        $that = $this;
        $errorModel = array(
            'error' => array(
                'type' => 'errorType',
                'message' => 'errorMessage',
            ),
        );

        $apiCommunication = function () use ($that) {
            $httpClient = $that->getMock('Aplazame\\Http\\ClientInterface');
            $httpClient->method('send')
                ->willThrowException(new ApiCommunicationException())
            ;

            return $httpClient;
        };
        $deserialization = function () use ($that) {
            $httpClient = $that->getMock('Aplazame\\Http\\ClientInterface');
            $httpClient->method('send')
                ->willReturn(new Response(200, '<html>'))
            ;

            return $httpClient;
        };
        $apiClient = function () use ($that, $errorModel) {
            $body = json_encode($errorModel);

            $httpClient = $that->getMock('Aplazame\\Http\\ClientInterface');
            $httpClient->method('send')
                ->willReturn(new Response(400, $body))
            ;

            return $httpClient;
        };
        $apiClientWithoutBody = function () use ($that) {
            $httpClient = $that->getMock('Aplazame\\Http\\ClientInterface');
            $httpClient->method('send')
                ->willReturn(new Response(400, null))
            ;

            return $httpClient;
        };

        $serverProblem = function () use ($that, $errorModel) {
            $body = json_encode($errorModel);

            $httpClient = $that->getMock('Aplazame\\Http\\ClientInterface');
            $httpClient->method('send')
                ->willReturn(new Response(500, $body))
            ;

            return $httpClient;
        };
        $serverProblemWithoutBody = function () use ($that) {
            $httpClient = $that->getMock('Aplazame\\Http\\ClientInterface');
            $httpClient->method('send')
                ->willReturn(new Response(500, null))
            ;

            return $httpClient;
        };

        return array(
            // Description => [client callable, exception]
            'Communication' => array($apiCommunication, 'Aplazame\\Api\\ApiCommunicationException'),
            'Deserialization' => array($deserialization, 'Aplazame\\Api\\DeserializeException'),
            'ApiClient' => array($apiClient, 'Aplazame\\Api\\ApiClientException'),
            'ApiClientWithoutBody' => array($apiClientWithoutBody, 'Aplazame\\Api\\ApiClientException'),
            'ServerProblem' => array($serverProblem, 'Aplazame\\Api\\ApiServerException'),
            'ServerProblemWithoutBody' => array($serverProblemWithoutBody, 'Aplazame\\Api\\ApiServerException'),
        );
    }
}
