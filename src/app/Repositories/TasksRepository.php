<?php

namespace App\Repositories;

use App\Models\Task;
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Repositories\RepositoryCrud;

class TasksRepository extends RepositoryCrud
{
    /**
     * TaskRepository constructor.
     * @param Task $model
     */
    #[Pure]
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * @param bool $pagination
     * @param int $perPage
     * @return mixed
     */
    public function index(bool $pagination = false, int $perPage = 6): mixed
    {
        $this->with(['getUser', 'getAdmin']);
        return parent::index($pagination, $perPage);

    }
}
