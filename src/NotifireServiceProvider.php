<?php

namespace Utyemma\Notifire;

use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use Utyemma\Notifire\Console\CreateMailable;

class NotifireServiceProvider extends SupportServiceProvider {

    function boot(){
        $this->registerCommands();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations/2024_01_18_133341_create_mailables_table.php');

        $this->publishes([
            __DIR__.'/../config/notifire.php' => config_path('notifire.php'),
        ], 'notifire-config');
        
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'notifire-migrations');
    }

    function registerCommands(){
        if($this->app->runningInConsole()){
            $this->commands([
                CreateMailable::class
            ]);
        }
    }

}