<?php

namespace Yish\Generators\Tests\Illuminate\Services;


use Yish\Generators\Foundation\Service\Service;
use Yish\Generators\Tests\Illuminate\Repositories\UserRepository;

class UserService extends Service
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}