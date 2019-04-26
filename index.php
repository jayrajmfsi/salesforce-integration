<?php
/**
 * Index file for showing the login button
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */

use SalesForce\ApiCaller\ApiCaller;

require_once(__DIR__ . '/vendor/autoload.php');

try {
    // fetch config
    $config = require_once 'app/config/config.php';

    // if login button is clicked perform an api call for salesforce authentication
    if (isset($_POST['login'])) {
        $apiCaller = new ApiCaller($config['authorizationRequestUrl']);

        $requestData = [
            'response_type' => 'code',
            'client_id' => $config['clientId'],
            'redirect_uri' => $config['redirectUri']
        ];
        // call the api
        $apiCaller->execute('GET', $requestData);

        $authorizationRequestUrl = $config['authorizationRequestUrl'];
        // create the authorization request url along with query parameters
        $authorizationRequestUrl .= '?' . http_build_query($requestData, null, '&', PHP_QUERY_RFC1738);

        // redirect to the authorization url
        header('Location: ' . $authorizationRequestUrl);

    }
} catch (Exception $exception) {
    print_r('Exception occurred due to: '. $exception->getMessage());
}
?>

<html>
    <body>
        <form method="post" action="index.php">
            <input type="submit" name="login" value="Login with SalesForce">
        </form>
    </body>

</html>
