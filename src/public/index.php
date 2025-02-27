<?php

require __DIR__ . '/../bootstrap.php';

/**
 * Erros log configuration
 */

error_reporting(E_ALL);

ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '/var/log/php/php-error.log');

set_exception_handler(function($exception) {
    error_log($exception->getMessage());
});
