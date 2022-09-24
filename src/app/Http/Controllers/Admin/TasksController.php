<?php

namespace App\Http\Controllers\Admin;

use App\{Http\Requests\Admin\Tasks\StoreRequest, Repositories\TasksRepository};
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;

class TasksController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $route = 'admin.task.';
    protected ?string $view = 'admin.modules.tasks.';

    /**
     * UsersController constructor.
     * @param TasksRepository $repository
     */
    #[Pure]
    public function __construct(TasksRepository $repository)
    {
        parent::__construct($repository);
    }


}
