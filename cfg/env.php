<?php
$env = getenv('APP_ENV') ?: 'dev';

if ($env === 'dev' || $env === 'development') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}
?>
