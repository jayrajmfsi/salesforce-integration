<?php
/**
 * Calling an add customer api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;
use SalesForce\Constants\GeneralConstants;
require_once __DIR__. '/../../../start.php';

// prepare request and headers
$requestData = [
    'name' => 'Predestination'
];
// fetch the previous set access token
$headerData = [
    'Content-Type' => GeneralConstants::JSON_CONTENT_TYPE,
    'Authorization' => GeneralConstants::HEADER_AUTHORIZATION_TYPE. ' '. $_SESSION['accessToken']
];

$baseUrl = $_SESSION['instanceUrl']. $config['accountUrl'];

$apiCaller = new ApiCaller($baseUrl);
// call the account add api
$response = $apiCaller->execute(GeneralConstants::HTTP_REQUEST_METHOD['post'], $requestData, $headerData);

print_r($response);

?>
