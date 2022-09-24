<?php

namespace MElaraby\Emerald\Controllers;

use App\Http\Controllers\Controller;
use BadMethodCallException;
use Error;
use Illuminate\Database\Eloquent\Model;
use MElaraby\Emerald\HttpFoundation\Response;
use MElaraby\Emerald\Repositories\Interfaces\RepositoryContractCrud;

/**
 * Class CrudControllerController
 * @package MElaraby\Emerald
 */
abstract class CrudControllerController extends Controller implements CrudControllerContract
{
    use CrudControllerHelper;

    /**
     * determine which view.
     *
     * @var string|null
     */
    protected ?string $view;

    /**
     * determine which route using.
     *
     * @var string|null
     */
    protected ?string $route;

    /**
     * determine which FormRequest use in store.
     *
     * @var string|null
     */
    protected ?string $storeRequest;

    /**
     * determine which FormRequest use in update.
     *
     * @var string|null
     */
    protected ?string $updateRequest;

    /**
     * determine the resource use it.
     *
     * @var string|null
     */
    protected ?string $theResource;

    /**
     * use pagination if needed default false.
     *
     * @var bool
     */
    protected bool $pagination = false;

    /**
     * pagination per page default 6.
     *
     * @var int
     */
    protected int $perPage = 6;

    /**
     * Controller constructor.
     * @param RepositoryContractCrud $repository determine which repository
     */
    public function __construct(protected RepositoryContractCrud $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return new Response(
            data: $this->repository->index($this->pagination, $this->perPage),
            view: $this->indexView()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return new Response(
            data: $this->repository->create([]),
            view: $this->storeView()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(): Response
    {
        $request = app($this->storeRequest);
        $model = $this->repository->store($request->validated());
        return new Response(
            redirect: $this->storeRedirect($model),
            alert: $this->storeAlert('success', 'تم الاضافة')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return new Response(
            data: $this->repository->show($id),
            view: $this->showView()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int|Model $id
     * @return Response
     */
    public function edit(int|Model $id): Response
    {
        return new Response(
            data: $this->repository->edit($id),
            view: $this->editView(),
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int|Model $id
     * @return Response
     */
    public function update(int|Model $id): Response
    {
        $request = app($this->updateRequest);
        return new Response(
            data: $model = $this->repository->update($request->validated(), $id),
            redirect: $this->updateRedirect($model),
            alert: $this->updateAlert('success', 'تم التعديل')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|Model $id
     * @return Response
     */
    public function destroy(int|Model $id): Response
    {
        $model = $this->repository->destroy($id);
        return new Response(
            redirect: $this->deleteRedirect($model),
            alert: $this->destroyAlert('success', 'تم المسح')
        );
    }

    /**
     * Change status of the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function status(int $id): Response
    {
        $this->repository->status($id);
        return new Response(
            route: $this->statusRedirect(),
            alert: $this->statusAlert('success', 'updated')
        );
    }

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed|string
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['storeRedirect', 'updateRedirect', 'deleteRedirect', 'statusRedirect'])) {
            return $this->homeRedirect();
        }

        if (in_array($method, ['storeAlert', 'updateAlert', 'destroyAlert', 'statusAlert'])) {
            return $this->alert($parameters[0], $parameters[1]);
        }

        if (in_array($method, ['indexView', 'storeView', 'showView', 'editView'])) {
            $viewName = explode("View", $method, 2)[0];
            return $this->view($viewName);
        }

        try {
            return $this->{$method}(...$parameters);
        } catch (Error|BadMethodCallException $e) {
            $pattern = '~^Call to undefined method (?P<class>[^:]+)::(?P<method>[^\(]+)\(\)$~';

            if (!preg_match($pattern, $e->getMessage(), $matches)) {
                throw $e;
            }

            if ($matches['class'] != get_class($this) || $matches['method'] != $method) {
                throw $e;
            }

            throw new BadMethodCallException(sprintf(
                'Call to undefined method %s::%s()', static::class, $method
            ));
        }
    }
}
