<?php

namespace RicardoFontanelli\LaravelFanout;

use Illuminate\Support\Facades\Facade;

class FanoutFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fanout';
    }
}
