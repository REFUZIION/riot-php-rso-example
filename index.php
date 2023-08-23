***REMOVED***
require_once('config.php');

$appCallbackUrl = BASE_URI . "callback.php";
$provider = "https://auth.riotgames.com";
$authorizeUrl = $provider . "/authorize";
$clientID = RIOT_CLIENT_ID;


$redirectUri = urlencode($appCallbackUrl);
$authorizationUrl = $authorizeUrl . "?redirect_uri=" . $redirectUri . "&client_id=" . $clientID . "&response_type=code&scope=openid";
?>
<a href="<?= $authorizationUrl ?>">
    Click to login with Riot
</a>
