<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    public function getTop10UsersWithTasks()
    {
        return Task::select('assigned_to_id', DB::raw('count(*) as total'))
            ->with('getUser')
            ->groupBy('assigned_to_id')
            ->get();
    }
}
