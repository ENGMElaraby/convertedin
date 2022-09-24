<?php

namespace App\Http\Controllers\Admin;

use App\{Http\Requests\Admin\Tasks\StoreRequest, Http\Resources\TasksResource, Repositories\TasksRepository};
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Controllers\CrudControllerController;
use MElaraby\Emerald\HttpFoundation\Response;

class TasksController extends CrudControllerController
{
    protected ?string $storeRequest = StoreRequest::class;
    protected ?string $route = 'admin.task.';
    protected ?string $view = 'admin.modules.tasks.';
    protected bool $pagination = true;
    protected int $perPage = 10;

    /**
     * UsersController constructor.
     * @param TasksRepository $repository
     */
    #[Pure]
    public function __construct(TasksRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        [$data, $totalRecords] = $this->repository->index($this->pagination, $this->perPage);
        return new Response(
            data: [
                'raw' => 1,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $this->perPage,
                'data' => TasksResource::collection($data)
            ],
            view: $this->indexView()
        );
    }


}
