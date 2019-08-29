<?php

namespace Aplazame\Api;

use Aplazame\Http\ClientInterface;
use Aplazame\Http\CurlClient;
use RuntimeException;

class Client
{
    const ENVIRONMENT_PRODUCTION = 'production';
    const ENVIRONMENT_SANDBOX = 'sandbox';

    /**
     * @var string
     */
    private $apiBaseUri;

    /**
     * @var bool
     */
    private $useSandbox;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @param string $apiBaseUri The API base URI.
     * @param string $environment Destination of the request.
     * @param string $accessToken The Access Token of the request (Public API key or Private API key)
     * @param ClientInterface|null $httpClient
     */
    public function __construct(
        $apiBaseUri,
        $environment,
        $accessToken,
        ClientInterface $httpClient = null
    ) {
        $this->apiBaseUri = $apiBaseUri;
        $this->useSandbox = ($environment === self::ENVIRONMENT_SANDBOX) ? true : false;
        $this->accessToken = $accessToken;
        $this->httpClient = $httpClient ? $httpClient : new CurlClient();
    }

    /**
     * Performs a DELETE request.
     *
     * @param string $path The path of the request.
     *
     * @return array The data of the response.
     *
     * @throws ApiCommunicationException if an I/O error occurs.
     * @throws DeserializeException if response cannot be deserialized.
     * @throws ApiServerException if server was not able to respond.
     * @throws ApiClientException if request is invalid.
     */
    public function delete($path)
    {
        return $this->request('DELETE', $path);
    }

    /**
     * Performs a GET request.
     *
     * @param string $path The path of the request.
     * @param array $query The filters of the request.
     *
     * @return array The data of the response.
     *
     * @throws ApiCommunicationException if an I/O error occurs.
     * @throws DeserializeException if response cannot be deserialized.
     * @throws ApiServerException if server was not able to respond.
     * @throws ApiClientException if request is invalid.
     */
    public function get($path, array $query = array())
    {
        if (!empty($query)) {
            $query = http_build_query($query);
            $path .= '?' . $query;
        }

        return $this->request('GET', $path);
    }

    /**
     * Performs a POST request.
     *
     * @param string $path The path of the request.
     * @param array $data The data of the request.
     *
     * @return array The data of the response.
     *
     * @throws ApiCommunicationException if an I/O error occurs.
     * @throws DeserializeException if response cannot be deserialized.
     * @throws ApiServerException if server was not able to respond.
     * @throws ApiClientException if request is invalid.
     */
    public function patch($path, array $data)
    {
        return $this->request('PATCH', $path, $data);
    }

    /**
     * Performs a POST request.
     *
     * @param string $path The path of the request.
     * @param array $data The data of the request.
     *
     * @return array The data of the response.
     *
     * @throws ApiCommunicationException if an I/O error occurs.
     * @throws DeserializeException if response cannot be deserialized.
     * @throws ApiServerException if an I/O error occurs.
     * @throws ApiClientException if request is invalid.
     */
    public function post($path, array $data)
    {
        return $this->request('POST', $path, $data);
    }

    /**
     * Performs a PUT request.
     *
     * @param string $path The path of the request.
     * @param array $data The data of the request.
     *
     * @return array The data of the response.
     *
     * @throws ApiCommunicationException if an I/O error occurs.
     * @throws DeserializeException if response cannot be deserialized.
     * @throws ApiServerException if server was not able to respond.
     * @throws ApiClientException if request is invalid.
     */
    public function put($path, array $data)
    {
        return $this->request('PUT', $path, $data);
    }

    /**
     * @param string $method The HTTP method of the request.
     * @param string $path The path of the request.
     * @param array|null $data The data of the request.
     *
     * @return array The data of the response.
     *
     * @throws ApiCommunicationException if an I/O error occurs.
     * @throws DeserializeException if response cannot be deserialized.
     * @throws ApiServerException if server was not able to respond.
     * @throws ApiClientException if request is invalid.
     */
    public function request($method, $path, array $data = null)
    {
        $uri = $this->apiBaseUri . '/' . ltrim($path, '/');

        $request = new ApiRequest($this->useSandbox, $this->accessToken, $method, $uri, $data);
        try {
            $response = $this->httpClient->send($request);
        } catch (RuntimeException $e) {
            throw ApiCommunicationException::fromException($e);
        }

        if ($response->getStatusCode() >= 500) {
            throw ApiServerException::fromResponse($response);
        }

        if ($response->getStatusCode() >= 400) {
            throw ApiClientException::fromResponse($response);
        }

        $payload = $this->decodeResponseBody((string) $response->getBody());

        return $payload;
    }

    /**
     * @param string $responseBody The HTTP response body.
     *
     * @return array Decoded payload.
     *
     * @throws DeserializeException if response cannot be deserialized.
     */
    protected function decodeResponseBody($responseBody)
    {
        // Response body is empty for HTTP 204 and 304 status code.
        if (empty($responseBody)) {
            return array();
        }

        $responseBody = json_decode($responseBody, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new DeserializeException('Unable to deserialize JSON data: ' . json_last_error_msg(), json_last_error());
        }

        return $responseBody;
    }
}
