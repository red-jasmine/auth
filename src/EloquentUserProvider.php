<?php

namespace RedJasmine\Auth;


use Illuminate\Auth\EloquentUserProvider as BaseEloquentUserProvider;
use RedJasmine\Auth\Models\User;

class EloquentUserProvider extends BaseEloquentUserProvider
{


    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
//        $model                                    = $this->createModel();
        $model                                    = new User();
        $model->{$model->getAuthIdentifierName()} = $identifier;
        // TODO 设置 JWTCustomClaims
        return $model;


        return $this->newModelQuery($model)
                    ->where($model->getAuthIdentifierName(), $identifier)
                    ->first();
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param mixed $identifier
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->createModel();

        $retrievedModel = $this->newModelQuery($model)->where(
            $model->getAuthIdentifierName(), $identifier
        )->first();

        if (!$retrievedModel) {
            return;
        }

        $rememberToken = $retrievedModel->getRememberToken();

        return $rememberToken && hash_equals($rememberToken, $token)
            ? $retrievedModel : null;


    }

}
