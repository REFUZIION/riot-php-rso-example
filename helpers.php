<?php

function ensureTrailingSlash($url)
{
    return rtrim($url, '/') . '/';
}

function validateConfig()
{
    if (!defined('BASE_URI') || !defined('RIOT_CLIENT_ID') || !defined('RIOT_CLIENT_SECRET')) {
        die('Missing required configuration constants. Please check your config.php file.');
    }

    if (!str_starts_with(strtolower(BASE_URI), 'https://')) {
        die('BASE_URI must use HTTPS. Riot Games RSO requires a secure connection.');
    }

    if (empty(RIOT_CLIENT_ID) || RIOT_CLIENT_ID === 'YOUR_CLIENT_ID_HERE') {
        die('Please set a valid RIOT_CLIENT_ID in config.php');
    }

    if (empty(RIOT_CLIENT_SECRET) || RIOT_CLIENT_SECRET === 'YOUR_CLIENT_SECRET_HERE') {
        die('Please set a valid RIOT_CLIENT_SECRET in config.php');
    }
}

function handleError($exception)
{
    error_log($exception->getMessage());

    if (strpos($exception->getMessage(), '401') !== false) {
        return 'Authentication failed. Please check your client credentials.';
    }

    if (strpos($exception->getMessage(), '404') !== false) {
        return 'Resource not found. Please check the API endpoints.';
    }

    return 'An unexpected error occurred. Please try again later.';
}
