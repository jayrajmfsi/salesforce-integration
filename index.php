<?php
/**
 * Index file for showing the login button
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */

use SalesForce\ApiCaller\ApiCaller;
use SalesForce\Constants\GeneralConstants;

require_once 'start.php';

try {
    // if login button is clicked perform an api call for salesforce authentication
    if (isset($_POST['login'])) {
        // prepare query data
        $requestData = [
            'response_type' => GeneralConstants::AUTH_RESPONSE_TYPE,
            'client_id' => $config['clientId'],
            'redirect_uri' => $config['redirectUri']
        ];
        $authorizationRequestUrl = GeneralConstants::AUTH_URL;
        // create the authorization request url along with query parameters
        $authorizationRequestUrl .= '?' . http_build_query($requestData, null, '&', PHP_QUERY_RFC1738);
        // decode the encoded url to send in the request
        $authorizationRequestUrl = urldecode($authorizationRequestUrl);

        $apiCaller = new ApiCaller($authorizationRequestUrl);

        // call the api for authentication
        $apiCaller->execute(GeneralConstants::HTTP_REQUEST_METHOD['get']);

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
