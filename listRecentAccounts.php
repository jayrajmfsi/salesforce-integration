<?php
/**
 * Calling an api for listing recent accounts for salesforce
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */

use SalesForce\ApiCaller\ApiCaller;

require_once 'start.php';

// fetch the previously set access token
$accessToken = $_SESSION['accessToken'];

// prepare request and headers
$headerData = [
    'Authorization' => "OAuth $accessToken"
];

$apiCaller = new ApiCaller($_SESSION['instanceUrl']. $config['accountUrl']);

// call the accounts list api
$response = $apiCaller->execute('GET', null, $headerData);

$accountList = $response['recentItems'];

echo 'List of Recent Accounts added: <br><br>';
foreach ($accountList as $index => $account) {
    $name = $account['Name'];
    $id = $account['Id'];
    echo "$index : Account Name: $name having Id: $id <br>";
}