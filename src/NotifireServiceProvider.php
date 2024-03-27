<?php

namespace Utyemma\Notifire;

use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use Utyemma\Notifire\Commands\CreateMailable;
use Utyemma\Notifire\Facades\Notifire;

class NotifireServiceProvider extends SupportServiceProvider {

    function boot(){
        $this->registerCommands();
        
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/2024_01_18_133341_create_mailables_table.php');

        $this->publishes([
            __DIR__.'/../config/notifire.php' => config_path('notifire.php'),
        ]);
        
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'notifire-migrations');

        $this->app->bind('notifire', function($app) {
            return new Notifire();
        });
    }

    function register() {
        $this->mergeConfigFrom(
            __DIR__.'/../config/notifire.php', 'notifire'
        );
    }

    function registerCommands(){
        if($this->app->runningInConsole()){
            $this->commands([
                CreateMailable::class
            ]);
        }
    }

}