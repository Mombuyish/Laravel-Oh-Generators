<?php

namespace Yish\Generators\Tests;

use Illuminate\Http\Response;
use Mockery as m;
use Yish\Generators\Tests\Illuminate\Blog\ErrorStatus;
use Yish\Generators\Tests\Illuminate\Blog\InstanceSuccess;
use Yish\Generators\Tests\Illuminate\Blog\InstanceFailed;
use Yish\Generators\Tests\Illuminate\Blog\NoGivenStatus;
use Yish\Generators\Tests\Illuminate\Blog\Success as DefaultSuccessTrait;
use Yish\Generators\Tests\Illuminate\Blog\Failed as DefaultFailedTrait;
use Yish\Generators\Tests\Illuminate\Blog\Custom\SuccessMessage as CustomSuccessMessage;
use Yish\Generators\Tests\Illuminate\Blog\Custom\FailedMessage as CustomFailedMessage;
use Yish\Generators\Tests\Illuminate\Blog\Custom\SuccessCode as CustomSuccessCode;
use Yish\Generators\Tests\Illuminate\Blog\Custom\FailedCode as CustomFailedCode;
use Yish\Generators\Tests\Illuminate\Blog\Custom\SuccessAll as CustomSuccessAll;
use Yish\Generators\Tests\Illuminate\Blog\Custom\FailedAll as CustomFailedAll;

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
    private function getItems()
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
     *
     */
    public function it_should_format_specific_data()
    {
        $message = 'Hello boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => $this->getItems(),
        ];

        $formatter = app(InstanceSuccess::class);

        $result = $formatter->format(request(), $this->getItems(), $message, Response::HTTP_OK);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     *
     */
    public function it_should_format_specific_data_with_failed()
    {
        $message = 'Failed.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
            'errors' => null,
        ];

        $formatter = app(InstanceFailed::class);

        $result = $formatter->format(request(), null, $message, Response::HTTP_INTERNAL_SERVER_ERROR);

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

        $formatter = app(DefaultSuccessTrait::class);

        $result = $formatter->format(request(), $this->getItems());

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

        $formatter = app(DefaultFailedTrait::class);

        $result = $formatter->format(request(), []);

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

        $formatter = app(CustomSuccessMessage::class);

        $result = $formatter->format(request(), $this->getItems());

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

        $formatter = app(CustomSuccessCode::class);

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
            'code' => Response::HTTP_ACCEPTED,
            'message' => $message,
            'items' => $this->getItems(),
        ];

        $formatter = app(CustomSuccessAll::class);

        $result = $formatter->format(request(), $this->getItems());

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_failed_by_trait()
    {
        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'Failed boys.',
            'errors' => null,
        ];

        $formatter = app(CustomFailedMessage::class);

        $result = $formatter->format(request(), null);

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
            'errors' => null,
        ];

        $formatter = app(CustomFailedCode::class);

        $result = $formatter->format(request(), null);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_failed_by_trait()
    {
        $errorMessage = 'Failed.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $errorMessage,
            'errors' => [],
        ];

        $formatter = app(CustomFailedAll::class);

        $result = $formatter->format(request(), []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_success()
    {
        $message = 'Hello boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => [
                1,
                2,
                3,
                4
            ],
        ];

        $result = format(request(), InstanceSuccess::class, [
            1,
            2,
            3,
            4
        ]);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_failed()
    {
        $message = 'Failed.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
            'errors' => null,
        ];

        $result = format(request(), InstanceFailed::class, null);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_success_by_helper()
    {
        $message = 'Hello boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_OK,
            'message' => $message,
            'items' => [],
        ];

        $result = format(request(), CustomSuccessMessage::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_success_by_helper()
    {
        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_ACCEPTED,
            'message' => 'Get something successful.',
            'items' => [],
        ];

        $result = format(request(), CustomSuccessCode::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_success_by_helper()
    {
        $message = 'Hello boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_ACCEPTED,
            'message' => $message,
            'items' => [],
        ];

        $result = format(request(), CustomSuccessAll::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_message_failed_by_helper()
    {
        $message = 'Failed boys.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'errors' => [],
        ];

        $result = format(request(), CustomFailedMessage::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_code_failed_by_helper()
    {
        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => 'Oops, something have wrong.',
            'errors' => [],
        ];

        $result = format(request(), CustomFailedCode::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_and_customize_all_failed_by_helper()
    {
        $message = 'Failed.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
            'errors' => [],
        ];

        $result = format(request(), CustomFailedAll::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_format_not_found_class_by_helper()
    {
        $this->expectException(\Yish\Generators\Exceptions\ClassNotFoundException::class);

        format(request(), ABCD::class, []);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function if_status_not_bool_got_exception()
    {
        $this->expectException(\Yish\Generators\Exceptions\InvalidArgumentException::class);

        format(request(), ErrorStatus::class, []);
    }

    /**
     * @test
     * @group package-formatter
     *
     * NOT FINISH.
     */
    public function if_status_no_given_will_be_false()
    {
        $message = 'Oops, something have wrong.';

        $expected = [
            'link' => url('/'),
            'method' => 'GET',
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'errors' => [],
        ];

        $result = format(request(), NoGivenStatus::class, []);

        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * @group package-formatter
     */
    public function it_should_get_code()
    {
        $result = app(DefaultSuccessTrait::class)->replaceCode();

        $this->assertEquals(200, $result->getCode());
    }
}
