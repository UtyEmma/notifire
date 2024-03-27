## Laravel Notifire
Create dynamic notifications and email messages using Laravel’s inbuilt notification system.

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
