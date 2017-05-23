<?php

namespace Yish\Generators\Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery as m;
use Yish\Generators\Tests\Illuminate\Repositories\UserRepository;
use Yish\Generators\Tests\Illuminate\Services\UserService;
use Yish\Generators\Tests\Illuminate\User as FakeUser;

class ServiceTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    private function mockRepository()
    {
        $repository = m::mock(UserRepository::class);
        $this->app->instance(UserRepository::class, $repository);

        return $repository;
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_all()
    {
        $this->mockRepository()
            ->shouldReceive('all')->once()
            ->andReturn(new Collection([
                new FakeUser(),
                new FakeUser(),
                new FakeUser(),
                new FakeUser(),
                new FakeUser(),
            ]));

        $service = $this->app->make(UserService::class)->all();

        $this->assertInstanceOf(Collection::class, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_create()
    {
        $this->mockRepository()
            ->shouldReceive('create')->once()
            ->andReturn(new FakeUser([
                'name' => 'yish',
                'email' => 'tt@tt.com',
            ]));

        $service = $this->app->make(UserService::class)->create([
            'name' => 'yish',
            'email' => 'tt@tt.com',
            'password' => bcrypt(123456),
        ]);

        $this->assertInstanceOf(FakeUser::class, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_first()
    {
        $this->mockRepository()
            ->shouldReceive('first')->once()
            ->andReturn(new FakeUser([
                'name' => 'yish',
                'email' => 'tt@tt.com',
            ]));

        $service = $this->app->make(UserService::class)->first();

        $this->assertArrayHasKey('name', $service);
        $this->assertArrayHasKey('email', $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_firstBy()
    {
        $this->mockRepository()
            ->shouldReceive('firstBy')->once()
            ->andReturn(new FakeUser([
                'name' => 'yish',
                'email' => 'tt@tt.com',
            ]));

        $service = $this->app->make(UserService::class)->firstBy('name', 'yish');

        $this->assertEquals('yish', $service->name);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_find()
    {
        $this->mockRepository()
            ->shouldReceive('find')->once()
            ->andReturn(new FakeUser([
                'id' => 1,
                'name' => 'yish',
                'email' => 'tt@tt.com',
            ]));

        $service = $this->app->make(UserService::class)->find(1);

        $this->assertEquals('yish', $service->name);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_findBy()
    {
        $this->mockRepository()
            ->shouldReceive('findBy')->once()
            ->andReturn(new FakeUser([
                'id' => 1,
                'name' => 'yish',
                'email' => 'tt@tt.com',
            ]));

        $service = $this->app->make(UserService::class)->findBy('name', 'yish');

        $this->assertEquals('tt@tt.com', $service->email);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_get()
    {
        $this->mockRepository()
            ->shouldReceive('get')->once()
            ->andReturn(new Collection([
                new FakeUser([
                    'id' => 1,
                    'name' => 'yish',
                    'email' => 'tt@tt.com',
                ]),
                new FakeUser([
                    'id' => 2,
                    'name' => 'yish1',
                    'email' => 'tt1@tt.com',
                ]),
            ]));

        $service = $this->app->make(UserService::class)->get();

        $this->assertInstanceOf(Collection::class, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_getBy()
    {
        $this->mockRepository()
            ->shouldReceive('getBy')->once()
            ->andReturn(new Collection([
                new FakeUser([
                    'id' => 1,
                    'name' => 'yish',
                    'email' => 'tt@tt.com',
                ]),
                new FakeUser([
                    'id' => 2,
                    'name' => 'yish',
                    'email' => 'tt1@tt.com',
                ]),
            ]));

        $service = $this->app->make(UserService::class)->getBy('name', 'yish');

        $this->assertInstanceOf(Collection::class, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_update()
    {
        $this->mockRepository()
            ->shouldReceive('update')->once()
            ->andReturn(true);

        $service = $this->app->make(UserService::class)->update(1, [
            'name' => 1,
        ]);

        $this->assertTrue($service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_updateBy()
    {
        $this->mockRepository()
            ->shouldReceive('updateBy')->once()
            ->andReturn(true);

        $service = $this->app->make(UserService::class)
            ->updateBy('name', 'yish', [
            'name' => 1,
        ]);

        $this->assertTrue($service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_destroy()
    {
        $this->mockRepository()
            ->shouldReceive('destroy')->once()
            ->andReturn(1);

        $service = $this->app->make(UserService::class)
            ->destroy(1);

        $this->assertEquals(1, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_destroyBy()
    {
        $this->mockRepository()
            ->shouldReceive('destroyBy')->once()
            ->andReturn(1);

        $service = $this->app->make(UserService::class)
            ->destroyBy('name', 'yish');

        $this->assertEquals(1, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_paginateBy()
    {
        $this->mockRepository()
            ->shouldReceive('paginateBy')->once()
            ->andReturn(new LengthAwarePaginator([
                new FakeUser([
                    'name' => 'yish'
                ]),
                new FakeUser([
                    'name' => 'yish'
                ]),
                new FakeUser([
                    'name' => 'yish'
                ]),
            ], 3, 1));

        $service = $this->app->make(UserService::class)
            ->paginateBy('name', 'yish', 3);

        $this->assertInstanceOf(LengthAwarePaginator::class, $service);
    }

    /**
     * @test
     * @group package-service
     */
    public function it_should_call_paginate()
    {
        $this->mockRepository()
            ->shouldReceive('paginate')->once()
            ->andReturn(new LengthAwarePaginator([
                new FakeUser([
                    'name' => 'yish'
                ]),
                new FakeUser([
                    'name' => 'yish'
                ]),
                new FakeUser([
                    'name' => 'yish'
                ]),
            ], 3, 1));

        $service = $this->app->make(UserService::class)
            ->paginate(3);

        $this->assertInstanceOf(LengthAwarePaginator::class, $service);
    }
}