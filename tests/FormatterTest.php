<?php

namespace Yish\Generators\Tests;

use Illuminate\Http\Response;
use Mockery as m;
use Yish\Generators\Tests\Illuminate\Post\CustomFormatter;
use Yish\Generators\Tests\Illuminate\Post\CustomStatusFailedFormatter;
use Yish\Generators\Tests\Illuminate\Post\CustomStatusFormatter;
use Yish\Generators\Tests\Illuminate\Post\Failed;
use Yish\Generators\Tests\Illuminate\Post\Success;
use Yish\Generators\Tests\Illuminate\Post\CustomMessage\Success as SuccessMessage;
use Yish\Generators\Tests\Illuminate\Post\CustomCode\Success as SuccessCode;
use Yish\Generators\Tests\Illuminate\Post\CustomCode\Failed as FailedCode;
use Yish\Generators\Tests\Illuminate\Post\CustomMessage\Failed as FailedMessage;
use Yish\Generators\Tests\Illuminate\Article\Failed as FailedTrait;
use Yish\Generators\Tests\Illuminate\Article\Success as SuccessTrait;

class FormatterTest extends TestCase
{
    /**
     * mockery close
     */
    public function tearDown()
    {
        m::close();
        parent::tearDown();
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $items = [
            [
                'name' => 'yish',
                'bio' => 'hummmmm...'
            ],

            [
                'name' => 'laraver',
                'bio' => 'the best.'
            ]
        ];
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_specific_data()
    {
        $message = 'Hello, I am test case.';

        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => $this->getItems(),
        ];

        $formatter = app(Success::class);

        $result = $formatter->format(request(), $this->getItems(), $message, Response::HTTP_OK);

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

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_success_by_trait()
    {
        $message = 'Get something successful.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => $this->getItems(),
        ];

        $formatter = app(SuccessTrait::class);

        $result = $formatter->format(request(), $this->getItems());

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_success_by_trait()
    {
        $message = 'Hello boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => $this->getItems(),
        ];

        $formatter = app(SuccessMessage::class);

        $result = $formatter->format(request(), $this->getItems(), $message, Response::HTTP_OK);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_success_by_trait()
    {
        $code = Response::HTTP_ACCEPTED;

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => $code,
            'message' => 'Get something successful.',
            'items' => $this->getItems(),
        ];

        $formatter = app(SuccessCode::class);

        $result = $formatter->format(request(), $this->getItems());

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_success_by_trait()
    {
        $message = 'Hello boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => $this->getItems(),
        ];

        $formatter = app(SuccessMessage::class);

        $result = $formatter->format(request(), $this->getItems(), $message, Response::HTTP_OK);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_failed_by_trait()
    {
        $errorMessage = 'Oops, something have wrong.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $errorMessage,
            'errors' => [],
        ];

        $formatter = app(FailedTrait::class);

        $result = $formatter->format(request(), [], [], Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_failed_by_trait()
    {
        $errorMessage = 'OOOOOOOops';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $errorMessage,
            'errors' => [],
        ];

        $formatter = app(FailedMessage::class);

        $result = $formatter->format(request(), [], $errorMessage, Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_failed_by_trait()
    {
        $errorMessage = 'OOOOOOOops';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $errorMessage,
            'errors' => [],
        ];

        $formatter = app(FailedMessage::class);

        $result = $formatter->format(request(), [], $errorMessage, Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_failed_by_trait()
    {
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => $code,
            'message' => 'Oops, something have wrong.',
            'errors' => [],
        ];

        $formatter = app(FailedCode::class);

        $result = $formatter->format(request());

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_success_by_helper()
    {
        $message = 'hello, world';

        $expected = [
                'link' => url('/test/package'),
                'method' => 'GET',
                'code' => Response::HTTP_OK,
                'message' => $message,
                'items' => [],
            ];

        $result = format(request(), Success::class, [], $message, Response::HTTP_OK);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_success_by_helper()
    {
        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_CREATED,
            'message' => '',
            'items' => [],
        ];

        $result = format(request(), Success::class, [], '', Response::HTTP_CREATED);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_success_by_helper()
    {
        $message = 'Hello';

        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_CREATED,
            'message' => $message,
            'items' => [],
        ];

        $result = format(request(), Success::class, [], $message, Response::HTTP_CREATED);

        $this->assertEquals($expected, $result);
    }


    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_failed_by_helper()
    {
        $message = 'hello, world';

        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'errors' => [],
        ];

        $result = format(request(), Failed::class, [], $message, Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_failed_by_helper()
    {
        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => '',
            'errors' => [],
        ];

        $result = format(request(), Failed::class, [], '', Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_failed_by_helper()
    {
        $message = 'Hello';

        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
            'errors' => [],
        ];

        $result = format(request(), Failed::class, [], $message, Response::HTTP_INTERNAL_SERVER_ERROR);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_empty_exception_by_helper()
    {
        $expected = [
            'link' => url('/test/package'),
            'method' => 'GET',
            'code' => '',
            'message' => '',
            'errors' => [],
        ];

        $result = format(request(), Failed::class, [], '', '');


        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_not_found_class_by_helper()
    {
        $this->expectException(\Yish\Generators\Exceptions\ClassNotFoundException::class);

        format(request(), ABCD::class, [], '', '');
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_not_found_method_by_helper()
    {
        $this->expectException(\Yish\Generators\Exceptions\MethodNotFoundException::class);

        format(request(), Failed::class, [], '', '', 'abcd');
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_set_message_if_not_empty()
    {
        $message = 'Hello';

        $formatter = $this->app->make(CustomFormatter::class);

        $formatter->format(request(), [], $message);

        $this->assertEquals($message, $formatter->getMessage());
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_set_code_if_status_true()
    {
        $formatter = $this->app->make(CustomStatusFormatter::class);

        $formatter->format(request(), [], '', '');

        $this->assertEquals(Response::HTTP_OK, $formatter->getCode());
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_set_code_if_status_false()
    {
        $formatter = $this->app->make(CustomStatusFailedFormatter::class);

        $formatter->format(request(), [], '', '');

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $formatter->getCode());
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_set_code_if_code_not_empty()
    {
        $formatter = $this->app->make(CustomStatusFormatter::class);

        $formatter->format(request(), [], '', Response::HTTP_NOT_MODIFIED);

        $this->assertEquals(Response::HTTP_NOT_MODIFIED, $formatter->getCode());
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_get_code()
    {
        $message = 'Hello';

        $formatter = $this->app->make(CustomFormatter::class);

        $formatter->format(request(), [], $message, Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $formatter->getCode());
    }
}
