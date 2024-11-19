<?php
require_once('config.php');
require_once('helpers.php');

// Validate configuration
validateConfig();

// Ensure proper URL formatting
$appCallbackUrl = ensureTrailingSlash(BASE_URI) . "callback.php";
$provider = "https://auth.riotgames.com";
$authorizeUrl = ensureTrailingSlash($provider) . "authorize";
$clientID = RIOT_CLIENT_ID;

$redirectUri = urlencode($appCallbackUrl);
$authorizationUrl = $authorizeUrl . "?redirect_uri=" . $redirectUri
    . "&client_id=" . $clientID
    . "&response_type=code"
    . "&scope=openid";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Riot Games Login</title>
</head>
<body>
    <a href="<?= htmlspecialchars($authorizationUrl) ?>">
        Click to login with Riot
    </a>
</body>
</html>
