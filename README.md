# Laravel Fanout
A simple and lightweight Laravel 4.2 and Laravel 5.* wrapper to interact with Fanout Service (fanout.io). Fanout is a SAAS that makes easy to build apps and APIs with realtime updates.

## Get Started:
* First of all, you should create an account on Fanout website (fanout.io)[https://fanout.io] to obtain the service credentials (Realm ID and Realm Key);
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

In Laravel find the `providers` key in your `config/app.php` and register the Laravel Fanout Service Provider.

```php
    // Laravel 4
    'providers' => array(
        // ...
        'RicardoFontanelli\LaravelFanout\FanoutServiceProvider',
    )

    // Laravel 5.*
    'providers' => [
        // ...
        RicardoFontanelli\LaravelFanout\FanoutServiceProvider::class,
    ]
```

Find the `aliases` key in your `config/app.php` and add the Laravel Fanout facade alias.

```php
    // Laravel 4.*
    'aliases' => array(
        // ...
        'Fanout' => 'RicardoFontanelli\LaravelFanout\FanoutFacade',
    )

    // Laravel 5.*
    'aliases' => [
        // ...
        'Fanout' => RicardoFontanelli\LaravelFanout\FanoutFacade::class,
    ]
```

## Publishing the package
Now, you should publish the package to generate the config file, after that, edit the config file with your Fanout credentials.

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
You have two options to test the front-end, the first is using the fanout Push Test Page, on Control Panel click the button "Push Test Page, on terminal open ```php artisan tinker ``` and run:

```php
// Send a notification
Fanout::publish('test', 'My first realtime message using Fanout.io!!');
```
The second one is creating a file called fanout.html like that, pay attention to change the information about your realm id: 
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

Now, open the file fanout.html send your first message usign ```php artisan tinker``` and run: 
```php
// Send a notification
Fanout::publish('my-channel', 'My first realtime message using Fanout.io!!');
```
You are free to change the channel name, fanout doesn't force you to create theses channels before send messages.

## Find more:
This is a simples service provider to help you to quickly implements Fanout in your app, you can find more details about the Fanout PHP sdk on [https://github.com/fanout/php-fanout]. Have a look at Fanout (Docs)[https://fanout.io/docs/] to see how to implement the service in your frontend;