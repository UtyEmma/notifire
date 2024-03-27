# Laravel Notifire
Create dynamic notifications and email messages using Laravel’s native notification system.

### Setup and Installation
Install Laravel Notifier in your project

```bash
composer install utyemma/laravel-notifire
```

If you intend to store your mail messages in your database, then you’ll be required to run migrations. 
(Note that this is the default setting)

```bash
php artisan migrate
```

### Usage
Create your first mailable class

```
php artisan make:mailable ExampleMailable
```

Format your mail message
Send your Notification

```php
//Send your first notification message
MyFirstEmail::send($user, [‘mail’, ‘database’]);

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

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [:author_name](https://github.com/:author_username)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
