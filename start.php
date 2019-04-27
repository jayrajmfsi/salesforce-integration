<?php

require_once(__DIR__ . '/vendor/autoload.php');
// fetch config
$config = require_once 'app/config/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}