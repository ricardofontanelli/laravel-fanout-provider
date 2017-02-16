<?php

namespace RicardoFontanelli\LaravelFanout;

use Illuminate\Support\ServiceProvider;
use Fanout;

class FanoutServiceProvider extends ServiceProvider
{
    /**
     * Abstract type to bind Sentry as in the Service Container.
     *
     * @var string
     */
    public static $abstract = 'fanout';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $app = $this->app;
        
        // Laravel 4.x compatibility
        if (version_compare($app::VERSION, '5.0') < 0) {
            $this->package('ricardofontanelli/laravel-fanout-provider', static::$abstract);
        } else {
            // the default configuration file
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path(static::$abstract . '.php'),
            ], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(static::$abstract . '.config', function ($app) {
            // provider_name::config is Laravel 4.x
            $user_config = $app['config'][static::$abstract] ?: $app['config'][static::$abstract . '::config'];
            // Make sure we don't crash when we did not publish the config file
            if (is_null($user_config)) {
                $user_config = [];
            }
            return $user_config;
        });

        $this->app->bind('Fanout\Fanout', function ($app) {

            $user_config = $app[static::$abstract . '.config'];
            
            return new Fanout\Fanout(
                $user_config['credentials']['realm_id'],
                $user_config['credentials']['realm_key']
            );
        });
        $this->app->singleton(static::$abstract, 'Fanout\Fanout');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [static::$abstract];
    }
}
