<?php

namespace RedJasmine\Auth\Models;


use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use RedJasmine\Support\Contracts\UserInterface;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class UserAbstract extends Authenticatable implements
    JWTSubject, AuthorizableContract,
    UserInterface
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
     *
     * @return UserAbstract
     */
    public function setUserType(string $userType) : UserAbstract
    {
        $this->userType = $userType;
        return $this;
    }

    public function getUid() : int
    {
        return (int)$this->getAuthIdentifier();
    }

    public function getNickname() : ?string
    {
        return $this->nickname ?? '';
    }

    public function getAvatar() : ?string
    {
        return $this->avatar ?? '';
    }


}
