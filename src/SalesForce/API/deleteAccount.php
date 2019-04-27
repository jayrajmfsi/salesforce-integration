<?php
/**
 * Calling a delete account api
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;
use SalesForce\Constants\GeneralConstants;

require_once __DIR__. '/../../../start.php';

session_start();

// prepare headers
$headerData = [
    'Authorization' => GeneralConstants::HEADER_AUTHORIZATION_TYPE. ' '. $_SESSION['accessToken']
];

$baseUrl = $_SESSION['instanceUrl']. $config['accountUrl']. '/'. $config['deleteAccountId'];
$apiCaller = new ApiCaller($baseUrl);
// call the account update api
$response = $apiCaller->execute(GeneralConstants::HTTP_REQUEST_METHOD['delete'], null, $headerData);

if (204 === $response['code']) {
    echo 'Deleted Successfully';
} else {
    print_r($response);
}

?>