<?php
namespace Yish\Generators\Tests\Illuminate\Repositories;

use Yish\Generators\Foundation\Repository\Repository;
use Yish\Generators\Tests\Illuminate\User;

class UserRepository extends Repository
{
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}