<?php
/**
 * Api form for containing the salesforce actions to perform
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
// list of options against the apis
$apiList = [
    'list_recent_accounts'=> 'listRecentAccounts.php',
    'add_account' => 'addAccount.php',
    'update_account' => 'updateAccount.php',
    'query_accounts' => 'queryAccounts.php',
    'delete_account' => 'deleteAccount.php',
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
      <input type="radio" value="add_account" name="api_name">Add Account
      <input type="radio" value="update_account" name="api_name">Update Account
      <input type="radio" value="list_recent_accounts" name="api_name">List Recent Accounts
      <input type="radio" value="query_accounts" name="api_name">Query list of accounts
      <input type="radio" value="delete_account" name="api_name">Delete Account
      <input type="submit" name="call_api" value="Execute">
    </form>
  </body>
</html>
