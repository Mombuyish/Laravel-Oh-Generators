<?php

namespace Yish\Generators\Tests\Illuminate\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;

class UserResponse implements Responsable
{
    protected $users;

    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    public function toResponse($request)
    {
        return response()->json($this->transform());
    }

    public function transform()
    {
        return $this->users->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
            ];
        });
    }
}
