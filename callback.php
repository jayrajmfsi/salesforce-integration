<?php
/**
 * Call back for fetching the access token
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
use SalesForce\ApiCaller\ApiCaller;

require_once 'start.php';

/**
 * Fetches the code from the query string and call the access token api
 */

try {
    // fetches the authorization code
    parse_str(($_SERVER['QUERY_STRING']),$qsArray);

    $code = $qsArray['code'];
    // prepare request data
    $requestData = array(
        'grant_type' => $config['grantType'],
        'code' => $code,
        'client_id' => $config['clientId'],
        'client_secret' => $config['clientSecret'],
        'redirect_uri' => $config['redirectUri']
    );
    $headerData = [
        'Content-Type' => 'application/x-www-form-urlencoded'
    ];
    // call the token api
    $apiCaller = new ApiCaller($config['tokenEndPointUrl']);

    $response = $apiCaller->execute('POST', $requestData, $headerData);

    // Setting the accessToken and instance for session variable
    $_SESSION['accessToken'] = $response['access_token'];
    $_SESSION['instanceUrl'] = $response['instance_url'];
} catch (Exception $exception) {
    print_r('Exception occurred due to: '. $exception->getMessage());
}

// redirect to api form to select one of the actions
header('Location: apiForm.php');
?>