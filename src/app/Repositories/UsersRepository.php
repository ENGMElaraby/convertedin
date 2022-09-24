<?php

namespace App\Repositories;

use App\Models\User;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class UsersRepository extends RepositoryCrud
{
    /**
     * UserRepository constructor.
     * @param User $model
     */
    #[Pure]
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
