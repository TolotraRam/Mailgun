<?php namespace Tolotra\Mailgun;

use Illuminate\Support\ServiceProvider;

class MailgunServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->package('tolotra/mailgun');
        $this->publishes([
            __DIR__ . '/../../config/mailgun.php' => config_path('mailgun.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['mailgun'] = $this->app->share(function($app){
            return new Mailgun($app['view']);
        });
        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Mailgun', 'Tolotra\Mailgun\Facades\Mailgun');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('mailgun');
    }
}
