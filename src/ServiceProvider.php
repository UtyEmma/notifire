<?php

namespace Utyemma\Notifire;

use App\Console\Commands\CreateMailable;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider {

    function boot(){
        $this->commands([
            CreateMailable::class
        ]);

        $this->publishes([
            __DIR__.'/../config/notifire.php' => config_path('notifire.php'),
        ]);
    }

}