<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use SalesForce\ApiCaller\ApiCaller;

require_once(__DIR__ . '/vendor/autoload.php');
$config = require_once 'config.php';

if (isset($_POST['login'])) {
    $apiCaller = new ApiCaller($config['authorizationRequestUrl']);
    $requestData = [
        'response_type' => 'code',
        'client_id' => $config['client_id'],
        'redirect_uri' => $config['redirect_uri']
    ];
    $apiCaller->execute('GET', $requestData);

    $authorizationRequestUrl = $config['authorizationRequestUrl'];
    $authorizationRequestUrl .= '?' . http_build_query($requestData, null, '&', PHP_QUERY_RFC1738);

    header('Location: '. $authorizationRequestUrl);
}

?>

<html>
    <body>
        <form method="post" action="index.php">
            <input type="submit" name="login" value="Login with SalesForce">
        </form>
    </body>

</html>
