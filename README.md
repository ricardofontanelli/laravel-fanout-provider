# Laravel Fanout
A simple and lightweight Laravel 4.2 and Laravel 5.* wrapper to interact with Fanout Service (fanout.io). Fanout is a SAAS that makes easy to build apps and APIs with realtime updates.

## Get Started:
* First of all, you should create an account on Fanout website (fanout.io) to obtains the service credentials (Realm ID and Realm Key);
* Install the lib via composer;
* Update the config file and be happy!

## Installation
The Laravel Fanout Service Provider can be installed via ...
```sh 
composer require ricardofontanelli/laravel-fanout-provider:1.0 
```
 or [Composer](http://getcomposer.org) by requiring the `ricardofontanelli/laravel-fanout-provider` package in your project's `composer.json`
```json
{
    "require": {
        "ricardofontanelli/laravel-fanout-provider": "1.0"
    }
}
```

Then run a composer update
```sh
php composer update
```

To use the Laravel Fanout Service Provider, you must register the provider when bootstrapping your application.

In Laravel find the `providers` key in your `config/app.php` and register the Laravel Telegram Service Provider.

```php
    'providers' => array(
        // ...
        'RicardoFontanelli\LaravelTelegram\FanoutServiceProvider',
    )
```

Find the `aliases` key in your `config/app.php` and add the Laravel Telegram facade alias.

```php
    'aliases' => array(
        // ...
        'Fanout' => 'RicardoFontanelli\LaravelFanout\FanoutFacade',
    )
```

After that, run the command above to publish the Fanout config file. 
## Publishing the package
Now, you should publish the package to generate the config file, after that, edit the config file with your Telegram Bot credentials.
### Laravel 4.2
The config file will be generate here: ```app/config/packages/ricardofontanelli/laravel-fanout-provider/config.php```
```php 
php artisan config:publish ricardofontanelli/laravel-fanout-provider
```
### Laravel 5.*
The config file will be generate here: ```app/config/fanout.php```
```php 
php artisan vendor:publish --provider="RicardoFontanelli\LaravelFanout\FanoutServiceProvider"
```
### Send a notification:
Create a file called fanout.html like that, pay attention to change the information about your realm id: 
```html
<!DOCTYPE html>
<html>
    <head>
        <title>My Awesome Fanout + Laravel Example</title>
        <script src="http://{YOUR-REALM-ID}.fanoutcdn.com/bayeux/static/faye-browser-min.js"></script>
    </head>
    <body>
        <h2>My Awesome Fanout + Laravel Example</h2>
        <script>
            var client = new Faye.Client('http://{YOUR-REALM-ID}.fanoutcdn.com/bayeux');
                client.subscribe('my-channel', function (data) {
                alert('Got data: ' + data);
            });
        </script>
    </body>
</html>
```

Now you can send your first message usign ```php artisan tinker``` and run: 
```php
// Send a notification
Fanout::publish('my-channel', 'My first realtime message using Fanout.io!!');
```

## Find more:
This is a simples service provider to help you to quickly implements Fanout in your app, you can find more details about the Fanout PHP sdk on [https://github.com/fanout/php-fanout]. Have a look at Fanout (Docs)[https://fanout.io/docs/] to see how to implement the service in your frontend;