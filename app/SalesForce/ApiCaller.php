<?php
/**
 * Calling different salesforce apis using guzzle
 * @Category Utility Class
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
namespace SalesForce\ApiCaller;

use GuzzleHttp\Client as Client;
use GuzzleHttp\TransferStats;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ApiCaller
{
    /** @var Client */
    private $client;

    /** @var Logger  */
    private $logger;

    /**
     * ApiCaller constructor.
     * Set the parameters for the guzzle client
     * @param $url
     * @throws \Exception
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
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/api.log', Logger::DEBUG));
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/exception.log', Logger::DEBUG));

    }

    /**
     * Execute an api call based on content type and method given
     * @param $method
     * @param $requestData
     * @param null $headers
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute($method, $requestData, $headers = null)
    {
        if ($method == 'POST' && $headers['Content-Type'] == 'application/x-www-form-urlencoded') {
            $dataFormat = 'form_params';
        } else if (($method == 'PATCH' || $method == 'POST') && $headers['Content-Type'] == 'application/json') {
            $dataFormat = 'json';
        } else {
            $dataFormat = 'query';
        }

        $response = [
            'status' => false
        ];

        try {
            $response = $this->client->request(
                $method,
                null,
                array(
                    $dataFormat => $requestData,
                    'headers' => $headers,
                    'on_stats' => function (TransferStats $stats) {
                        // log the statitics of the api call
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
                        $this->logger->debug('API Request: ', $requestDetails);
                    }
                )
            );

            $statusCode = $response->getStatusCode();

            // if there is an empty body then return back the status code
            if ($response->getBody()) {
                $response = json_decode($response->getBody()->getContents(), TRUE);
                $response['code'] = $statusCode;
            } else {
                $response['code'] = $statusCode;
            }
            if (is_array($response)) {
                $this->logger->debug('API Response: ', $response);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Exception: '. $exception->getMessage());
        }

        return $response;
    }
}
