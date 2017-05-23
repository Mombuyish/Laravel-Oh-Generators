<?php

namespace Yish\Generators\Foundation\Service;


abstract class Service
{
    /**
     * @var \Yish\Generators\Foundation\Repository\Repository
     */
    protected $repository;

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * @param $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes)
    {
        return $this->repository->create($attributes);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->repository->first();
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function firstBy($column, $value)
    {
        return $this->repository->firstBy($column, $value);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findBy($column, $value)
    {
        return $this->repository->findBy($column, $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get()
    {
        return $this->repository->get();
    }

    /**
     * @param $column
     * @param $value
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getBy($column, $value)
    {
        return $this->repository->getBy($column, $value);
    }

    /**
     * @param $id
     * @param $attributes
     * @return bool|int
     */
    public function update($id, $attributes)
    {
        return $this->repository->update($id, $attributes);
    }

    /**
     * @param $column
     * @param $value
     * @param $attributes
     * @return bool
     */
    public function updateBy($column, $value, $attributes)
    {
        return $this->repository->updateBy($column, $value, $attributes);
    }

    /**
     * @param $id
     * @return bool|int|null
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    /**
     * @param $column
     * @param $value
     * @return bool|null
     */
    public function destroyBy($column, $value)
    {
        return $this->repository->destroyBy($column, $value);
    }

    /**
     * @param string $column
     * @param $value
     * @param int $page
     * @return mixed
     * @internal param $id
     */
    public function paginateBy($column, $value, $page = 12)
    {
        return $this->repository->paginateBy($column, $value, $page);
    }

    /**
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($page = 12)
    {
        return $this->repository->paginate($page);
    }
}