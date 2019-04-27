<?php
/**
 * General constant needs for calling salesforce apis
 * @author Jayraj Arora<jayraja@mindfiresolutions.com>
 */
namespace SalesForce\Constants;

class GeneralConstants
{
    const AUTH_URL = 'https://login.salesforce.com/services/oauth2/authorize';
    const AUTH_RESPONSE_TYPE = 'code';
    const ACCESS_TOKEN_URL = 'https://login.salesforce.com/services/oauth2/token';
    const GRANT_TYPE = 'authorization_code';
    const URL_ENCODED_CONTENT_TYPE = 'application/x-www-form-urlencoded';
    const JSON_CONTENT_TYPE = 'application/json';
    const HEADER_AUTHORIZATION_TYPE = 'OAuth';
    const SAMPLE_ACCOUNT_QUERY = 'select name from Account where CreatedDate>';
    const HTTP_REQUEST_METHOD = [
        'get' => 'GET',
        'patch' => 'PATCH',
        'post' => 'POST',
        'delete' => 'DELETE'
    ];
}