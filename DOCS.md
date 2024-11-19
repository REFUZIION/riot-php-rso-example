# Riot RSO Example: Documentation

This example project demonstrates how to implement user login with Riot Games and fetch user data.

Three PHP files are used in this example:

1. `index.php` : Main entry point, the user interface.
2. `callback.php` : Handles callbacks from Riot server.
3. `config.php` : Contains configuration constants.

## index.php

This page simply presents a link to the user, which, when clicked, sends a GET request to the Riot authorization server
with necessary parameters to initiate the OAuth2 flow.

## callback.php

This page is responsible for handling the redirection from Riot server after the user logs in. It also instantiates the
OAuth2 client using the `League\OAuth2\Client` library and then makes a POST request to Riot's token endpoint to
exchange the authorization code for an access token. The access token is then used to make a GET request to Riot's
account details endpoint, where user data is fetched.

```php
$responseBody = json_decode($response->getBody(), true);
$accessToken = $responseBody['access_token'];
$riotResponse = $client->get('https://europe.api.riotgames.com/riot/account/v1/accounts/me', ['headers' => ['Authorization' => "Bearer {$accessToken}", 'Accept' => 'application/json']]);
```

## config.php

This configuration file contains minimal configuration settings for the example. Replace YOUR_CLIENT_ID_HERE with the
client ID assigned to your application by Riot Games and YOUR_CLIENT_SECRET_HERE with the client secret.

```php
<?php
const BASE_URI = 'localhost.test';
const RIOT_CLIENT_ID = 'YOUR_CLIENT_ID_HERE';
const RIOT_CLIENT_SECRET = 'YOUR_CLIENT_SECRET_HERE';
```

Please make sure to include your dependencies as well, in this case guzzlehttp and League\OAuth2\Client, via composer by
running `composer require guzzlehttp/guzzle` and `composer require league/oauth2-client`.
