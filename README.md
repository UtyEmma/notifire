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
composer require utyemma/notifire
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

#### Format your mail message



#### Send a Notification using the Mailable Class
```php
    use App\Mailable\ExampleMailable;

    //Send your first notification message
    (new ExampleMailable)->send($user, ['mail', 'database']);
```   

#### Send a notification by laravel default mail message formatting

Your can learn more about Laravel's default mail message formatting from the [Laravel Documentation](https://laravel.com/docs/11.x/notifications#formatting-mail-messages)

```php
    use Utyemma\Notifire\Notification;
    use App\Models\User;

    $users = User::all();

    //Send your first notification message
    Notify::subject('Your Notification Subject')
                ->greeting('Hello!')
                ->line('You have a new message.')
                ->line('Thank you for using our application!');
                ->send($users, ['mail', 'database']);
```

Alternatively, if your wish to send a mail instead of create a notification, you can do so by replacing the send method with the 'mail' method

```php
use Utyemma\Notifire\Notification;
use App\Models\User;

$recievers = ['admin@example.com', 'user@example.com'];

$data = [
    'name' => 'John Doe'
];

//Send your first notification message
(new Notification)->subject('Your Notification Subject', $data)
                ->greeting('Hello {{name}}')
                ->line('You have a new message.')
                ->line('Thank you for using our application!');
                ->mail($recievers);
```

## Customizing the Templating Engine
By default, this package makes use of [mustache](https://mustache.github.io/) as the default templating system to handle basic templating data. You can learn more about using mustache via the [php documentation](https://github.com/bobthecow/mustache.php)

However, you are free to use any custom template engine supported by PHP for your entire application or for a single mailable class. You can do so by registering custom template resolvers as shown below

#### Registering a custom template resolver for a specific mailable class
This example sets the default resolver to make use of Laravel's blade templating engine. You can learn more about Laravel Blade [here](https://laravel.com/docs/11.x/blade)

```php
    namespace App\Mailable;

    use Illuminate\Support\Facades\Blade;
    use Utyemma\Notifire\Notification;

    class ExampleMailable extends Notification {
        public function setResolver($content, $placeholders){
            return new Blade::render($content, $placeholders);
        }
    }
```

##### Configuring for all mailable classes
Here is an example using handlebars templating engine. Learn more about using Handle Bars in your Laravel Application. [Handle Bars Docs](https://github.com/salesforce/handlebars-php)

1. Create a simple invokeable class that returns a static renderEngine method

```php
    use Handlebars\Handlebars;

    class HandleBarsResolver {

        function __invoke($content, $placeholders){
            return (new Handlebars)->render($content, $placeholders);
        }

    }
```

2. Update the 'resolver' item in your config file

```php
    use App\Notifire\Resolvers\HandleBarsResolver;

    return [
        'resolver' => HandleBarsResolver::class
    ];
```

> If this class is provided it willl be used in resolving the templates. You must ensure your your mail messages are formatted based on the templating engine you are using as your resolver. 


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

- [Utibe-Abasi Emmanuel](https://github.com/UtyEmma)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
