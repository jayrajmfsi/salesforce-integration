<?php
/**
 * Calling an update customer api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;

require_once 'start.php';

session_start();

$requestData = [
    'name' => 'AccountUsingGuzzleTest'
];
// prepare request data
$accessToken = $_SESSION['accessToken'];
$headerData = [
    'Content-Type' => 'application/json',
    'Authorization' => "OAuth $accessToken"
];

$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['accountUrl']. $config['sampleAccountId']);
// call the account update api
$response = $apiCaller->execute('PATCH', $requestData, $headerData);

if (204 === $response['code']) {
    echo 'Updated Successfully';
}

?>