<?php
/**
 * Calling an add customer api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;

require_once 'start.php';

$requestData = [
    'name' => 'Predestination'
];

// fetch the previously set access token
$accessToken = $_SESSION['accessToken'];

// prepare request and headers
$headerData = [
    'Content-Type' => 'application/json',
    'Authorization' => "OAuth $accessToken"
];

$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['accountUrl']);
// call the account add api
$response = $apiCaller->execute('POST', $requestData, $headerData);

print_r($response);
?>