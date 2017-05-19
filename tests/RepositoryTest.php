<?php

namespace Yish\Generators\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Mockery as m;
use Yish\Generators\Tests\Illuminate\Repositories\UserRepository;
use Yish\Generators\Tests\Illuminate\User as FakeUser;
use Illuminate\Contracts\Console\Kernel;

class RepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', [
            '--path' => 'tests/Illuminate/Migrations'
        ]);
    }

    public function tearDown()
    {
        m::close();

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }

    /**
     * @test
     * @group package-repository
     */
    public function it_should_take_all()
    {
        $user = FakeUser::create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
            'password' => bcrypt(123456),
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
        $user = FakeUser::create([
            'name' => 'yish',
            'email' => 'yish@tt.com',
            'password' => bcrypt(123456),
        ]);

        app(UserRepository::class)->update($user->id, [
            'name' => 'hello'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'hello'
        ]);
    }
}