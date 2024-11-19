# Riot Games RSO PHP Example

A production-ready implementation example of Riot Games' RSO (Riot Sign On) authentication system using PHP. This repository demonstrates secure OAuth2 integration with Riot Games' authentication services, following best practices and security standards.

## Features

- Complete OAuth2 authentication flow with Riot Games
- Secure token handling and validation
- User account information retrieval
- Error handling and validation
- HTTPS enforcement for security

## Prerequisites

- PHP 8.0 or higher
- SSL certificate (HTTPS is required for Riot Games OAuth2)
- Composer
- A registered Riot Games Developer account
- Valid RSO credentials from the Riot Developer Portal

## Dependencies

This project relies on the following packages:
- `guzzlehttp/guzzle`: ^7.7.0 (HTTP client)
- `league/oauth2-client`: ^2.7.0 (OAuth2 client implementation)
- `kdefives/oauth2-riot`: ^1.0.0 (Riot Games OAuth2 provider)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/REFUZIION/riot-php-rso-example.git
cd riot-php-rso-example
```

2. Install dependencies:
```bash
composer install
```

3. Create your configuration file:
```bash
cp config.example.php config.php
```

4. Update `config.php` with your credentials:
```php
const BASE_URI = 'https://your-domain.com/'; // Must use HTTPS
const RIOT_CLIENT_ID = 'YOUR_CLIENT_ID_HERE';
const RIOT_CLIENT_SECRET = 'YOUR_CLIENT_SECRET_HERE';
```

## Configuration Requirements

- **BASE_URI**: Must use HTTPS protocol
- **RIOT_CLIENT_ID**: Obtained from Riot Developer Portal
- **RIOT_CLIENT_SECRET**: JWT token from Riot Developer Portal

## Usage

1. Ensure your web server is configured with SSL/TLS
2. Direct users to the index page to initiate login
3. Users will be redirected to Riot's authentication page
4. After successful authentication, users return to your callback URL
5. User information will be displayed (customize as needed)

## Security Considerations

- HTTPS is mandatory for all operations
- Input validation is implemented
- Output is properly sanitized
- Proper error handling is in place

## Directory Structure

```
├── config.php           # Configuration file
├── config.example.php   # Example configuration template
├── index.php           # Entry point
├── callback.php        # OAuth callback handler
├── helpers.php         # Utility functions
├── DOCS.md            # Technical documentation
└── composer.json      # Dependencies and autoloading
```

## Error Handling

The application includes error handling for:
- Missing or invalid configuration
- Network failures
- Authentication errors
- Invalid responses
- Missing required data

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Acknowledgements

- [kdefives/oauth2-riot](https://github.com/kdefives/oauth2-riot) for the OAuth2 provider implementation
- [Riot Games Developer Portal](https://developer.riotgames.com/) for the authentication documentation

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For issues and feature requests, please use the [GitHub Issues](https://github.com/REFUZIION/riot-php-rso-example/issues) page.

## Author

REFUZIION - [GitHub Profile](https://github.com/REFUZIION)
