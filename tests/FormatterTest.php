<?php

namespace Yish\Generators\Tests;

use Illuminate\Http\Response;
use Mockery as m;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Yish\Generators\Tests\Illuminate\Post\Failed;
use Yish\Generators\Tests\Illuminate\Post\Success;

class FormatterTest extends TestCase
{
    public function tearDown()
    {
        m::close();
        parent::tearDown();
    }
    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_specific_data()
    {
        $items = [
            [
                'name' => 'yish',
                'bio' => 'hummmmm...'
            ],

            [
                'name' => 'laraver',
                'bio' => 'the best.'
            ]
        ];

        $message = 'Hello, I am test case.';

        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => $items,
        ];

        $formatter = app(Success::class);

        $result = $formatter->format(request(), $items, $message, Response::HTTP_OK);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_specific_data_with_failed()
    {
        $message = 'Oops, something have wrong?';

        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'errors' => null,
        ];

        $formatter = app(Failed::class);

        $result = $formatter->format(request(), null, $message, Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals($expected, $result);
    }


}