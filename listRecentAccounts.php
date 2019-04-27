<?php
/**
 * Calling an api for listing recent accounts for salesforce
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */

use SalesForce\ApiCaller\ApiCaller;
use SalesForce\Constants\GeneralConstants;

require_once 'start.php';

// prepare header
$headerData = [
    'Authorization' => GeneralConstants::HEADER_AUTHORIZATION_TYPE. ' '. $_SESSION['accessToken']
];

$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['accountUrl']);

// call the accounts list api
$response = $apiCaller->execute(GeneralConstants::HTTP_REQUEST_METHOD['get'], null, $headerData);

$accountList = $response['recentItems'];

echo 'List of Recent Accounts added: <br><br>';
foreach ($accountList as $index => $account) {
    $name = $account['Name'];
    $id = $account['Id'];
    echo "$index : Account Name: $name having Id: $id <br>";
}