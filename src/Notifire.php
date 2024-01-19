<?php

namespace Utyemma\Notifire;

use Illuminate\Support\Facades\Facade;

class Notifire extends Facade {
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'notifire';
    }
}