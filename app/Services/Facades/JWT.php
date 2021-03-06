<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class JWT extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'App\Services\JWT';
    }
}
