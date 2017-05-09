<?php

namespace Yish\Generators\Foundation\Service;


abstract class BaseService
{
    /**
     * @var \Eloquent|\DB
     */
    protected $repository;

    public function create($attributes)
    {
        return $this->repository->create($attributes);
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->repository->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    public function paginateBy($id, $page = 12, $column = 'id')
    {
        return $this->repository->paginateBy($id, $page, $column);
    }
}