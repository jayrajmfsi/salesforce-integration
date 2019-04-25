<?php
require_once(__DIR__ . '/vendor/autoload.php');

use SalesForce\ApiCaller\ApiCaller;

$config = include('config.php');

session_start();

$requestData = [
    'name' => 'AccountUsingGuzzle'
];

$accessToken = $_SESSION['accessToken'];
$headerData = [
    'Content-Type' => 'application/json',
    'Authorization' => "OAuth $accessToken"
];
$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['customer_url']);
$response = $apiCaller->execute('POST', $requestData, $headerData);

print_r($response);
?>