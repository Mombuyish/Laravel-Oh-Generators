<?php

namespace Yish\Generators\Foundation\Service;


abstract class BaseService
{
    protected $reposiroy;

    public function create($attributes)
    {
        return $this->reposiroy->create($attributes);
    }

    public function show($id)
    {
        return $this->reposiroy->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->reposiroy->update($id, $attributes);
    }

    public function destroy($id)
    {
        return $this->reposiroy->delete($id);
    }

    public function paginateBy($id, $page = 12, $column = 'id')
    {
        if ($column != 'id') {
            return $this->reposiroy->paginateByColumn($id, $page);
        }

        return $this->reposiroy->paginateBy($id, $page);
    }
}