<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserRepository extends Repository  implements UserRepositoryInterface
{

    protected Model $model;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
