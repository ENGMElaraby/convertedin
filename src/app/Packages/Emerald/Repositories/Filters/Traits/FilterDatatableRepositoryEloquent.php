<?php

namespace MElaraby\Emerald\Repositories\Filters\Traits;

use Illuminate\{Pagination\LengthAwarePaginator, Pagination\Paginator, Support\Collection};

trait FilterDatatableRepositoryEloquent
{
    private array $columns = [];

    /**
     * @var object
     */
    private object $search;

    /**
     * @var object
     */
    private object $order;

    /**
     * @param array $filter
     */
    public function datatable(array $filter): void
    {
        $this->setColumns($filter['columns'])
            ->setSearch($filter['search'])
            ->setOrdering($filter['order']);

    }

    /**
     * @param array $ordering
     * @return $this
     */
    private function setOrdering(array $ordering): self
    {
        $ordering = $ordering[0];
        $this->order = (object)[
            'column' => $this->columns[(int)$ordering['column']]->name,
            'columnIndex' => (int)$ordering['column'],
            'dir' => $ordering['dir'],
        ];

        return $this;
    }

    /**
     * @param array $search
     * @return $this
     */
    private function setSearch(array $search): self
    {
        $this->search = (object)$search;

        return $this;
    }

    /**
     * @param array $columns
     * @return FilterDatatableRepositoryEloquent
     */
    private function setColumns(array $columns): self
    {
        foreach ($columns as $column) {
            $this->columns[] = (object)$column;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    protected function returnDatatable(): mixed
    {
        $start = request()->start;

        $length = request()->length;

        $page = ($start / $length + 1);

        return $this->query->paginate($length, ['*'], 'page', $page);
    }

    /**
     * @return LengthAwarePaginator
     */
    private function responseEmptyPagination(): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage() ?: 1;
        $items = Collection::make([]);
        return new LengthAwarePaginator($items->forPage($page, 1), $items->count(), 1, $page, []);
    }
}
