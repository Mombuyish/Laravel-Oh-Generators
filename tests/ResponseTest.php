<?php

namespace Yish\Generators\Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Route;
use Yish\Generators\Tests\Illuminate\Responses\UserResponse;
use Yish\Generators\Tests\Illuminate\User as FakeUser;

class ResponseTest extends TestCase
{
    /**
     * @test
     * @group package-foundation
     */
    public function it_should_return_specific_data()
    {
        $userYish = [
            'id' => 1,
            'name' => 'yish',
            'email' => 'yish@tt.com',
            'password' => bcrypt(123456),
        ];

        $userGoodjack = [
            'id' => 2,
            'name' => 'goodjack',
            'email' => 'goodjack@tt.com',
            'password' => bcrypt(123456),
        ];

        $users = new Collection([
            new FakeUser($userYish),
            new FakeUser($userGoodjack),
        ]);

        Route::get('/user', function () use ($users) {
            return new UserResponse($users);
        });

        $expected = $users->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
            ];
        });

        $this->get('/user')
            ->assertJsonFragment($expected[0])
            ->assertJsonFragment($expected[1]);
    }
}
