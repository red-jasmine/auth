<?php

namespace RedJasmine\Auth\Models;


use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Liushoukun\LaravelProjectTools\Contracts\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class UserAbstract extends Authenticatable implements
    JWTSubject, AuthorizableContract,
    User
{
    use Authorizable;


    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * 用户类型
     * @var string
     */
    protected string $userType = 'user';

    /**
     * 所属人
     * @return User|null
     */
    public function getOwner() : User|null
    {
        return null;
    }


    public function getJWTIdentifier()
    {
        return $this->getAuthIdentifier();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() : array
    {
        return [];
    }


    /**
     * @return string
     */
    public function getUserType() : string
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     * @return UserAbstract
     */
    public function setUserType(string $userType) : UserAbstract
    {
        $this->userType = $userType;
        return $this;
    }

    public function getUid() : string|int
    {
        return $this->getAuthIdentifier();
    }


}
