<?php

require_once __DIR__.'/vendor/autoload.php';

use SalesForce\ApiCaller\ApiCaller;
session_start();

function processCode()
{

    // Create SDK instance
    $config = include('config.php');

    $code = parseAuthRedirectUrl($_SERVER['QUERY_STRING']);

    $requestData = array(
        'grant_type' => $config['grant_type'],
        'code' => $code,
        'client_id' => $config['client_id'],
        'client_secret' => $config['client_secret'],
        'redirect_uri' => $config['redirect_uri']
    );
    $headerData = [
      'Content-Type' => 'application/x-www-form-urlencoded'
    ];
    $apiCaller = new ApiCaller($config['tokenEndPointUrl']);
    $response = $apiCaller->execute('POST', $requestData, $headerData);
    /*
     * Setting the accessToken for session variable
     */
    $_SESSION['accessToken'] = $response['access_token'];
    $_SESSION['instanceUrl'] = $response['instance_url'];
}


function parseAuthRedirectUrl($url)
{
    parse_str($url,$qsArray);
    return $qsArray['code'] ;
}

processCode();

header('Location: apiForm.php');
?>