# Laravel Notifire

[![Latest Version on Packagist](https://img.shields.io/packagist/v/utyemma/notifire.svg?style=flat-square)](https://packagist.org/packages/utyemma/notifire)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/:vendor_slug/:package_slug/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/:vendor_slug/:package_slug/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/utyemma/notifire.svg?style=flat-square)](https://packagist.org/packages/utyemma/notifire)
<!--delete-->
---
Create dynamic notifications and email messages using Laravel’s native notification system.

## Setup and Installation
Install Laravel Notifier in your project

```bash
composer install utyemma/laravel-notifire
```

If you intend to store your mail messages in your database, then you’ll be required to run migrations. 
(Note that this is the default setting)

```bash
php artisan migrate
```

## Usage
Create your first mailable class

```
php artisan make:mailable ExampleMailable
```

Format your mail message
Send your Notification

```php
use App\Mailable\ExampleMailable;

//Send your first notification message
ExampleMailable::send($user, ['mail', 'database’]);
```   

## Testing
```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

If you discover any security-related issues, please email  [utyemma@gmail.com](mailto:utyemma@gmail.com) instead of using the issue tracker.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
