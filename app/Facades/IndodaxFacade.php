<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class IndodaxFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'idx';
    }
}
