<?php

namespace RedJasmine\Auth\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Foundation\Auth\Access\Authorizable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use RedJasmine\Support\Contracts\BelongToOwner;
use RedJasmine\Support\Contracts\User;

abstract class UserAbstract implements JWTSubject, AuthenticatableContract, AuthorizableContract, User, BelongToOwner
{
    use Authenticatable, Authorizable;
    use SelfOwner;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected string $primaryKey = 'id';
    /**
     * 用户类型
     * @var string
     */
    protected string $userType = 'user';

    public function getKeyName() : string
    {

        return $this->primaryKey;
    }

    public function getJWTIdentifier()
    {
        return $this->getAuthIdentifier();
    }

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

    public function getType() : string|int
    {
        return 'user';
    }

    public function getUid() : string|int
    {
        return $this->getAuthIdentifier();
    }


}
