<?php

namespace MElaraby\Emerald\Repositories;

use Exception;
use Illuminate\{Database\Eloquent\Collection, Database\Eloquent\Model};
use JetBrains\PhpStorm\Pure;
use MElaraby\Emerald\Repositories\Interfaces\RepositoryContractCrud;

abstract class RepositoryCrud extends Repository implements RepositoryContractCrud
{
    /**
     * CrudRepository constructor.
     *
     * @param Model $model
     */
    #[Pure]
    public function __construct(Model $model)
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
        $this->newQuery()->eagerLoad()->setClauses();

        $model = $this->query;

        if ($pagination) {
            return $model->paginate($perPage);
        }

        return $model->get(['*']);
    }

    /**
     * @param array $data
     * @return array
     */
    public function create(array $data = [])
    {
        return [];
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $this->model::create($data);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function show(int $id)
    {
        return $this->find($id);
    }

    /**
     * @param int|Model $id
     * @return Model
     */
    public function edit(int|Model $id)
    {
        if ($id instanceof Model) {
            return $id;
        }
        return $this->find($id);
    }

    /**
     * @param int|Model $id
     */
    public function destroy(int|Model $id): mixed
    {
        if ($id instanceof Model) {
            $id->delete();
            return $id;
        }

        $model = $this->find($id);
        if ($model) {
            $model->delete();
            return $model;
        }
        throw new \RuntimeException('Not found resource');
    }

    /**
     * @param int $id
     */
    public function status(int $id): void
    {
        $model = $this->find($id);
        $this->update([
            'status' => (bool)$model->status
        ], $model);
    }

    /**
     * @param array $data
     * @param int|Model $id
     */
    public function update(array $data, $id): mixed
    {
        if ($id instanceof Model) {
            $model = $id;
        } else {
            $model = $this->find($id);
        }
        $model->update($data);
        return $model;
    }
}
