<?php

namespace RedJasmine\Auth;


use Illuminate\Auth\EloquentUserProvider as BaseEloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use RedJasmine\Auth\Models\User;
use RedJasmine\Auth\Models\UserAbstract;

class EloquentUserProvider extends BaseEloquentUserProvider
{

    protected array $config;

    public function __construct(HasherContract $hasher, $model, array $config = [])
    {

        parent::__construct($hasher, $model);
        $this->config = $config;
    }


    /**
     * Gets the name of the Eloquent user model.
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     * @return Authenticatable|UserAbstract
     */
    public function retrieveById($identifier)
    {

        $class = '\\'.ltrim($this->config['jwt_model']??"\\RedJasmine\\Auth\\Models\\User", '\\');
        $model                                    = new $class();
        $model->{$model->getAuthIdentifierName()} = $identifier;
        return $model;
    }


}
