<?php
/**
 * Calling an update customer api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
require_once(__DIR__ . '/vendor/autoload.php');

use SalesForce\ApiCaller\ApiCaller;

session_start();

$requestData = [
    'name' => 'AccountUsingGuzzle1'
];
// prepare request data
$accessToken = $_SESSION['accessToken'];
$headerData = [
    'Content-Type' => 'application/json',
    'Authorization' => "OAuth $accessToken"
];

$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['customerUrl']. $config['sampleAccountId']);
// call the update api
$response = $apiCaller->execute('PATCH', $requestData, $headerData);

if (204 === $response['code']) {
    echo 'Updated Successfully';
}

?>