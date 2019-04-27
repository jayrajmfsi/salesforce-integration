<?php
/**
 * Calling a query api for fetching account according to created datetime
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;
use SalesForce\Constants\GeneralConstants;

require_once 'start.php';

$requestData = [
  'q' => GeneralConstants::SAMPLE_ACCOUNT_QUERY. $config['createdDateTime']
];

// prepare headers
$headerData = [
    'Authorization' => GeneralConstants::HEADER_AUTHORIZATION_TYPE. ' '. $_SESSION['accessToken']
];

$baseUrl = $_SESSION['instanceUrl']. $config['queryUrl'];

$apiCaller = new ApiCaller($baseUrl);

$response = $apiCaller->execute(GeneralConstants::HTTP_REQUEST_METHOD['get'], $requestData, $headerData);

echo 'List of Accounts name and their uris: <br><br>';
foreach ($response['records'] as $account) {
    $uri = $account['attributes']['url'];
    $name = $account['Name'];
    echo "$name account accessed by the uri: $uri <br>";
}

$count = $response['totalSize'];
echo "<br><br> Total Records: $count";