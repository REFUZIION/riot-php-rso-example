<?php

/**
 * Riot Games RSO Callback Handler
 *
 * This script handles the OAuth2 callback from Riot Games authentication.
 * It processes the authorization code, exchanges it for an access token,
 * and retrieves the user's account information.
 */

declare(strict_types=1);

require_once('config.php');
require_once('helpers.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

// Validate configuration before proceeding
validateConfig();

// Verify the authorization code is present
if (!isset($_GET['code'])) {
    die('Authorization code is missing. Please try logging in again.');
}

// Initialize OAuth2 provider
$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => RIOT_CLIENT_ID,
    'urlAuthorize'           => 'https://auth.riotgames.com/authorize',
    'urlAccessToken'         => 'https://auth.riotgames.com/token',
    'urlResourceOwnerDetails' => 'https://auth.riotgames.com/userinfo'
]);

// Configure HTTP client with reasonable timeouts
$client = new \GuzzleHttp\Client([
    'timeout'         => 30,
    'connect_timeout' => 5,
    'http_errors'     => true,
    'verify'          => true
]);

try {
    // Step 1: Exchange authorization code for access token
    $tokenResponse = $client->post('https://auth.riotgames.com/token', [
        'form_params' => [
            'grant_type'            => 'authorization_code',
            'code'                  => $_GET['code'],
            'redirect_uri'          => ensureTrailingSlash(BASE_URI) . 'callback.php',
            'client_id'             => RIOT_CLIENT_ID,
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'client_assertion'      => RIOT_CLIENT_SECRET
        ]
    ]);

    $tokenData = json_decode($tokenResponse->getBody()->getContents(), true);

    if (!isset($tokenData['access_token'])) {
        throw new RuntimeException('Access token not found in response');
    }

    // Step 2: Fetch user account information
    $accountResponse = $client->request(
        'GET',
        'https://europe.api.riotgames.com/riot/account/v1/accounts/me',
        [
            'headers' => [
                'Authorization' => sprintf('Bearer %s', $tokenData['access_token']),
                'Accept'        => 'application/json',
            ]
        ]
    );

    $accountData = json_decode($accountResponse->getBody()->getContents(), true);

    // Validate required user data fields
    $requiredFields = ['gameName', 'tagLine', 'puuid'];
    foreach ($requiredFields as $field) {
        if (!isset($accountData[$field])) {
            throw new RuntimeException(sprintf('Missing required field: %s', $field));
        }
    }

    // Prepare sanitized user data
    $userData = [
        'riot_id' => htmlspecialchars($accountData['gameName']),
        'tagline' => htmlspecialchars($accountData['tagLine']),
        'puuid'   => htmlspecialchars($accountData['puuid'])
    ];
} catch (Exception $e) {
    $errorMessage = handleError($e);
    die($errorMessage);
}

// Render the response
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riot Account Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        pre {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <h1>Token Response</h1>
    <pre><?php print_r($tokenData); ?></pre>

    <h1>User Information</h1>
    <pre><?php print_r($userData); ?></pre>
</body>

</html>
