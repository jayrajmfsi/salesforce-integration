<?php
/**
 * Calling an add customer api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
require_once(__DIR__ . '/vendor/autoload.php');

use SalesForce\ApiCaller\ApiCaller;

session_start();

$requestData = [
    'name' => 'AccountUsingGuzzle'
];
// fetch the previously set access token
$accessToken = $_SESSION['accessToken'];

// prepare request and headers
$headerData = [
    'Content-Type' => 'application/json',
    'Authorization' => "OAuth $accessToken"
];

$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['customerUrl']);
// call the customer add api
$response = $apiCaller->execute('POST', $requestData, $headerData);

print_r($response);
?>