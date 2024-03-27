<?php

namespace Utyemma\Notifire\Facades;

use Illuminate\Support\Facades\Facade;

class Notifire extends Facade {

    protected static function getFacadeAccessor(){
        return 'notifire';
    }

}