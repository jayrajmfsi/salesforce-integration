<?php
/**
 * Calling an update account api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;
use SalesForce\Constants\GeneralConstants;

require_once __DIR__. '/../../../start.php';

session_start();

$requestData = [
    'name' => 'AccountUsingGuzzleTest'
];
// prepare headers
$headerData = [
    'Content-Type' => GeneralConstants::JSON_CONTENT_TYPE,
    'Authorization' => GeneralConstants::HEADER_AUTHORIZATION_TYPE. ' '. $_SESSION['accessToken']
];

$baseUrl = $_SESSION['instanceUrl']. $config['accountUrl']. '/'. $config['sampleAccountId'];
$apiCaller = new ApiCaller($baseUrl);
// call the account update api
$response = $apiCaller->execute(GeneralConstants::HTTP_REQUEST_METHOD['patch'], $requestData, $headerData);

if (204 === $response['code']) {
    echo 'Updated Successfully';
} else {
    print_r($response);
}

?>