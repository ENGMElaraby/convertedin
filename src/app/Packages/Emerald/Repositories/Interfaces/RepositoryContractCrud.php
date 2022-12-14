<?php

namespace MElaraby\Emerald\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\AssignOp\Mod;

interface RepositoryContractCrud
{
    /**
     * @param bool $pagination
     * @param int $perPage
     * @return mixed
     */
    public function index(bool $pagination, int $perPage);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function edit(int $id);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param int|Model $id
     * @return mixed
     */
    public function destroy(int|Model $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function status(int $id);
}
