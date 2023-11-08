# Riot Games RSO PHP Example

This repository provides an example implementation of Riot Games' RSO (Riot Sign On) using PHP. The primary goal of this project is to demonstrate how the RSO system can be integrated into a PHP application.

It is based on various composer packages including but not limited to `guzzlehttp/guzzle:7.7.0`, `kdefives/oauth2-riot:v1.0.0`, `league/oauth2-client:2.7.0`.

## Acknowledgement

-   Special recognition to [kdefives/oauth2-riot](https://github.com/kdefives/oauth2-riot) for serving as an excellent guide and resource.

## Prerequisites

Ensure that you have PHP 5.6.0 or above installed before proceeding.

## Installation & Setup

Follow these steps for setting up this project on your local system.

1.  Clone the repository:
    ```bash
    git clone https://github.com/REFUZIION/riot-php-rso-example.git .
    ```

2. Install the necessary composer packages:
    ```bash
    composer install
    ```
   
3. Update the config.php with your own details:
    ```php
    const BASE_URI = 'localhost.test';
    const RIOT_CLIENT_ID = 'YOUR_CLIENT_ID_HERE';
    const RIOT_CLIENT_SECRET = 'YOUR_CLIENT_SECRET_HERE';
   ```

## Documentation
For more technical details and usage explanations, refer to the project's [documentation](DOCS.md).

If you have any more changes you would like to make, please feel free to ask. I'm here to assist you.
