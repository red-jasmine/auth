<?php

namespace RedJasmine\Auth\Models;

use Liushoukun\LaravelProjectTools\Contracts\User;

trait SelfOwner
{

    public function getOwner() : User
    {
        return $this;
    }

}
