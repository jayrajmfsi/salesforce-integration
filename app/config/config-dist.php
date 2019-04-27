<?php
/**
 * SalesForce Rest API integration file
 * This file should be renamed "config.php" in the same directory
 */

return array(
    // can be fetched from the app created in account
    'clientId' => 'Account Client Id',
    'clientSecret' => 'Account Client Secret',
    // uri to redirect to
    'redirectUri' => 'Callback URL',
    // account sobject url
    'accountUrl' => 'Account api url',
    // id to fetch in update account api
    'sampleAccountId' => 'Account Id ',
    // sample id to perform delete account api
    'deleteAccountId' => 'Account Id',
    // created Date time used while running the query for fetching list of accounts
    'createdDateTime' => 'Entered as the datetime object'
);