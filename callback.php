<?php
/**
 * Call back for fetching the access token
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
require_once __DIR__.'/vendor/autoload.php';

use SalesForce\ApiCaller\ApiCaller;

session_start();

/**
 * Fetches the code from the query string and call the access token api
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
function processCode()
{
    try {
        // fetch config
        $config = include('app/config/config.php');

        // fetches the authorization code
        $code = parseAuthRedirectUrl($_SERVER['QUERY_STRING']);

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
        print_r(__FUNCTION__. 'failed due to error: '. $exception->getMessage());
    }
}

/**
 * Parse the url to fetch code
 * @param $url
 * @return mixed
 */
function parseAuthRedirectUrl($url)
{
    parse_str($url,$qsArray);

    return $qsArray['code'] ;
}

processCode();
// redirect to api form to select one of the actions
header('Location: apiForm.php');
?>