Laravel Notifire

Create dynamic notifications and email messages using Laravel’s inbuilt notification system.

Setup and Installation

Usage

Install Laravel Notifier in your project

composer install utyemma/laravel-notifire

If you intend to store your mail messages in your database, then you’ll be required to run migrations. 
(Note that this is the default setting)

php artisan migrate

Create your first mailable class

php artisan make:mailable MyFirstEmail

Format your mail message

Send your Notification
MyFirstEmail::send($user, [‘mail’, ‘database’])
