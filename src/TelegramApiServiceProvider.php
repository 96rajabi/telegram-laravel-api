<?php


namespace Mahdiidea\TelegramApi;


use Illuminate\Support\ServiceProvider;

class TelegramApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('telegram', function () {
            return new TelegramGateway();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $config = __DIR__ . '/../config/telegram.php';

        $this->publishes([
            $config => config_path('telegram.php'),
        ], 'config');
    }
}
