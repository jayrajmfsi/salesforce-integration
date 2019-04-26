<?php
/**
 * Api form for containing the salesforce actions to perform
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
session_start();
// list of options against the apis
$apiList = [
    'listCustomer'=> 'getCustomers.php',
    'addCustomer' => 'addCustomer.php',
    'updateCustomer' => 'updateCustomer.php',
];

if ($_POST['call_api']) {
    $callApi = $apiList[$_POST['api_name']];
}
// redirect to the respective script
header('Location: '.$callApi);
?>


<html>
<body>
<form method="post" action="apiForm.php">
    <input type="radio" value="addCustomer" name="api_name">Add Customer
    <input type="radio" value="updateCustomer" name="api_name">Update Customer
    <input type="submit" name="call_api" value="Execute">
</form>
</body>
</html>
