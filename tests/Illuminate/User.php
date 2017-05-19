<?php

namespace Yish\Generators\Tests\Illuminate;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $guarded = [];
}