***REMOVED***
require_once('config.php');
require_once $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId' => RIOT_CLIENT_ID,
    'urlAuthorize' => 'https://auth.riotgames.com/authorize',
    'urlAccessToken' => 'https://auth.riotgames.com/token',
    'urlResourceOwnerDetails' => 'https://auth.riotgames.com/userinfo'
]);

if (!isset($_GET['code'])) {
    die('code is not set.');
}

$client = new \GuzzleHttp\Client();
try {
    $response = $client->post('https://auth.riotgames.com/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'redirect_uri' => BASE_URI . 'callback.php',
            'client_id' => RIOT_CLIENT_ID,
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'client_assertion' => RIOT_CLIENT_SECRET
        ]
    ]);

    $responseBody = json_decode($response->getBody(), true);
    ?>
    <h1>https://auth.riotgames.com/token::Response</h1>
    ***REMOVED*** var_dump($responseBody); ?>
    ***REMOVED***
    $accessToken = $responseBody['access_token'];

    $riotResponse = $client->request(
        'GET', 'https://europe.api.riotgames.com/riot/account/v1/accounts/me',
        [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Accept' => 'application/json',
            ]
        ]);

    $userResponseBody = json_decode($riotResponse->getBody(), true);
    $userData = [
        'riot_id' => $userResponseBody['gameName'],
        'tagline' => $userResponseBody['tagLine'],
        'epuuid' => $userResponseBody['puuid'],
    ];
} catch (Exception $e) {
    echo $e;
    die('Something went wrong.');
}
?>
<h1>https://europe.api.riotgames.com/riot/account/v1/accounts/me::Response</h1>
***REMOVED*** var_dump($userResponseBody) ?>
