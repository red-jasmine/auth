<?php

namespace RedJasmine\Auth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RedJasmine\Auth\Auth
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RedJasmine\Auth\Auth::class;
    }
}
