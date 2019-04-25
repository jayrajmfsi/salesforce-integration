<?php
require_once(__DIR__ . '/vendor/autoload.php');

use SalesForce\ApiCaller\ApiCaller;

$config = include('config.php');

session_start();

$requestData = [
    'name' => 'AccountUsingGuzzle1'
];

$accessToken = $_SESSION['accessToken'];
$headerData = [
    'Content-Type' => 'application/json',
    'Authorization' => "OAuth $accessToken"
];
$id = '/0010K000021GoTzQAK';
$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['customer_url']. $id);
$response = $apiCaller->execute('PATCH', $requestData, $headerData);

if (204 === $response['code']) {
    echo 'Updated Successfully';
}

?>