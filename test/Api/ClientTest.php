<?php

namespace Aplazame\Api;

use Aplazame\Http\ClientInterface;
use Aplazame\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Aplazame\Api\Client
 */
class ClientTest extends TestCase
{
    public function testSuccessRequest()
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient->method('send')
            ->willReturnCallback(function (ApiRequest $apiRequest) {
                ClientTest::assertEquals('GET', $apiRequest->getMethod(), 'getMethod not match');
                ClientTest::assertEquals('http://api.example.com/path', $apiRequest->getUri(), 'getUri not match');

                $headers = $apiRequest->getHeaders();
                ClientTest::assertEquals('application/vnd.aplazame.sandbox.v1+json', $headers['Accept'][0], 'Accept header not match');
                ClientTest::assertEquals('Bearer fooAccessToken', $headers['Authorization'][0], 'Authorization header not match');

                return new Response(200, '{"foo": "value"}');
            })
        ;

        $client = new Client(
            'http://api.example.com',
            Client::ENVIRONMENT_SANDBOX,
            'fooAccessToken',
            $httpClient
        );

        $response = $client->request('get', '/path');

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

        $this->expectException($exception);

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

        $apiCommunication = static function () use ($that) {
            $httpClient = $that->createMock(ClientInterface::class);
            $httpClient->method('send')
                ->willThrowException(new ApiCommunicationException())
            ;

            return $httpClient;
        };
        $deserialization = static function () use ($that) {
            $httpClient = $that->createMock(ClientInterface::class);
            $httpClient->method('send')
                ->willReturn(new Response(200, '<html>'))
            ;

            return $httpClient;
        };
        $apiClient = static function () use ($that, $errorModel) {
            $body = json_encode($errorModel);

            $httpClient = $that->createMock(ClientInterface::class);
            $httpClient->method('send')
                ->willReturn(new Response(400, $body))
            ;

            return $httpClient;
        };
        $apiClientWithoutBody = static function () use ($that) {
            $httpClient = $that->createMock(ClientInterface::class);
            $httpClient->method('send')
                ->willReturn(new Response(400, null))
            ;

            return $httpClient;
        };

        $serverProblem = static function () use ($that, $errorModel) {
            $body = json_encode($errorModel);

            $httpClient = $that->createMock(ClientInterface::class);
            $httpClient->method('send')
                ->willReturn(new Response(500, $body))
            ;

            return $httpClient;
        };
        $serverProblemWithoutBody = static function () use ($that) {
            $httpClient = $that->createMock(ClientInterface::class);
            $httpClient->method('send')
                ->willReturn(new Response(500, null))
            ;

            return $httpClient;
        };

        return array(
            // Description => [client callable, exception]
            'Communication' => array($apiCommunication, ApiCommunicationException::class),
            'Deserialization' => array($deserialization, DeserializeException::class),
            'ApiClient' => array($apiClient, ApiClientException::class),
            'ApiClientWithoutBody' => array($apiClientWithoutBody, ApiClientException::class),
            'ServerProblem' => array($serverProblem, ApiServerException::class),
            'ServerProblemWithoutBody' => array($serverProblemWithoutBody, ApiServerException::class),
        );
    }
}
