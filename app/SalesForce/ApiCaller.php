<?php

namespace SalesForce\ApiCaller;

use GuzzleHttp\Client as Client;
use GuzzleHttp\TransferStats;
use http\Params;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ApiCaller
{
    /** @var Client */
    private $client;

    private $logger;

    /**
     * Set the parameters for the guzzle client
     * @param $url
     */
    public function __construct($url)
    {
        // Create a client with a base URI and certain options
        /** @var Client client */
        $this->client = new Client(
            [
                'base_uri' => $url,
                'timeout' => 30,
                'connect_timeout' => 30,
                'http_errors' => false
            ]
        );
        $this->logger = new Logger('api');

        $this->logger->pushHandler(new StreamHandler(__DIR__.'/app.log', Logger::DEBUG));

    }

    public function execute($method, $requestData, $headers = null)
    {
        if ($method == 'POST' && $headers['Content-Type'] == 'application/x-www-form-urlencoded') {
            $dataFormat = 'form_params';
        } else if (($method == 'PATCH' || $method == 'POST') && $headers['Content-Type'] == 'application/json') {
            $dataFormat = 'json';
        }else {
            $dataFormat = 'query';
        }
        try {
            $response = $this->client->request(
                $method,
                null,
                array(
                    $dataFormat => $requestData,
                    'headers' => $headers,
                    'on_stats' => function (TransferStats $stats) {
                        $code = null;
                        if ($stats->hasResponse()) {
                            $code = $stats->getResponse()->getStatusCode();
                        }
                        $requestDetails = array(
                            'uri' => $stats->getEffectiveUri(),
                            'transferTime' => $stats->getTransferTime(),
                            'stats' => $stats->getHandlerStats(),
                            'code' => $code,
                            'request' => (array)$stats->getRequest(),
                        );
                        $this->logger->debug('request: ', $requestDetails);
                    }
                )
            );
            $statusCode = $response->getStatusCode();
            if ($response->getBody()) {
                $response = json_decode($response->getBody()->getContents(), TRUE);
                $response['code'] = $statusCode;
            } else {
                $response['code'] = $statusCode;
            }
            if (is_array($response)) {
                $this->logger->debug('res: ', $response);
            }

            return $response;

        } catch (\Exception $exception) {
            echo 'Api call failed due to '. $exception->getMessage();
        }
    }
}

