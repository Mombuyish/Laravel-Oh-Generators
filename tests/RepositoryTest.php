<?php

namespace Yish\Generators\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use Mockery as m;
use Yish\Generators\Tests\Illuminate\Repositories\UserRepository;
use Yish\Generators\Tests\Illuminate\User as FakeUser;
use Illuminate\Contracts\Console\Kernel;

class RepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_take_all()
    {
        $user = factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        $result = app(UserRepository::class)->find(1);

        $this->assertEquals($user->name, $result->name);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_create()
    {
        $data = [
            'name' => 'yish',
            'email' => 'yish@tt.com',
            'password' => bcrypt(123456),
        ];

        app(UserRepository::class)->create($data);

        $this->assertDatabaseHas('users', $data);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_update()
    {
        $user = factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        app(UserRepository::class)->update($user->id, [
            'name' => 'hello'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'hello'
        ]);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_update_by_column()
    {
        factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        app(UserRepository::class)->updateBy('name', 'yish', [
            'name' => 'hello',
            'email' => 'yy@tt.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'hello',
            'email' => 'yy@tt.com',
        ]);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_first()
    {
        factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        $user = app(UserRepository::class)->first();

        $this->assertEquals('yish', $user->name);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_firstBy()
    {
        factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        $user = app(UserRepository::class)->firstBy('email', 'yish@tt.com');

        $this->assertEquals('yish', $user->name);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_find()
    {
        factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        $user = app(UserRepository::class)->find(1);

        $this->assertEquals('yish', $user->name);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_findBy()
    {
        factory(FakeUser::class)->create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
        ]);

        $user = app(UserRepository::class)->findBy('name', 'yish');

        $this->assertEquals('yish', $user->name);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_get()
    {
        factory(FakeUser::class)->times(5)->create();

        $user = app(UserRepository::class)->get();

        $this->assertCount(5, $user);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_getBy()
    {
        factory(FakeUser::class)->times(5)->create([
            'name' => 'yish'
        ]);

        factory(FakeUser::class)->create();

        $user = app(UserRepository::class)->getBy('name', 'yish');

        $this->assertCount(5, $user);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_destroy()
    {
        factory(FakeUser::class)->times(5)->create([
            'name' => 'yish'
        ]);

        app(UserRepository::class)->destroy([1,2,3,4,5]);

        $this->assertDatabaseMissing('users', [
            'name' => 'yish'
        ]);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_destroyBy()
    {
        factory(FakeUser::class)->times(2)->create([
            'name' => 'yish'
        ]);

        factory(FakeUser::class)->create([
            'name' => 'hello'
        ]);

        app(UserRepository::class)->destroyBy('name', 'yish');

        $this->assertDatabaseMissing('users', [
            'name' => 'yish'
        ]);
        $this->assertDatabaseHas('users', [
            'name' => 'hello'
        ]);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_paginate()
    {
        factory(FakeUser::class)->times(10)->create([
            'name' => 'yish'
        ]);

        $result = app(UserRepository::class)->paginate(5);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_paginateBy()
    {
        factory(FakeUser::class)->times(5)->create([
            'name' => 'yish'
        ]);

        factory(FakeUser::class)->times(5)->create([
            'name' => 'hello'
        ]);

        $result = app(UserRepository::class)->paginateBy('name', 'yish', 2);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }
}