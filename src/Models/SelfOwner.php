<?php

namespace RedJasmine\Auth\Models;

trait SelfOwner
{

    public function getOwner() : \RedJasmine\Support\Contracts\User
    {
        return $this;
    }

}
