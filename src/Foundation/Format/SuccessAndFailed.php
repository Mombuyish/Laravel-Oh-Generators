<?php

namespace Yish\Generators\Foundation\Format;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\Concerns\FormatFailed;
use Yish\Generators\Foundation\Format\Concerns\HasCode;
use Yish\Generators\Foundation\Format\Concerns\HasMessage;
use Yish\Generators\Foundation\Format\Concerns\FormatSuccess;

trait SuccessAndFailed
{
    use HasMessage,
        HasCode,
        FormatSuccess,
        FormatFailed;

    /**
     * Success message.
     *
     * @var string
     */
    protected $message = 'Get something successful.';

    /**
     * Failed message.
     *
     * @var string
     */
    protected $errorMessage = 'Oops, something have wrong.';

    /**
     * Return property.
     *
     * @var static
     */
    protected $result;

    /**
     * Operation interface.
     *
     * @param Request $request
     * @param array $items
     * @param string $message
     * @param int $code
     * @return static
     */
    public function format(Request $request, $items = [], $message = '', $code = 200)
    {
        // set $this->message
        // if it have customize method message, replace it.
        // or not if status true(success) given a default success message,
        // or failed message.
        $this->replaceMessage($message);

        // set $this->code
        // if it have customize method code, replace it.
        // or not if status true(success) given a default success code,
        // or failed code.
        $this->replaceCode($code);

        return $this->formatting($request, $items, $this->code)->getResult();
    }

    /**
     * Progressing formatting.
     *
     * @param Request $request
     * @param array $items
     * @param $code
     * @return $this
     */
    public function formatting(Request $request, $items = [], $code)
    {
        return static::formatted($request, $items, $code);
    }

    /**
     * Progressing final endpoint.
     *
     * @param Request $request
     * @param array $items
     * @param $code
     * @return $this
     */
    public function formatted(Request $request, $items = [], $code)
    {
        $base = $this->setBaseFormat($request);

        $default = $this->setDefaultFormat($code);

        $this->result = $this->setStatusFormat(array_merge($base, $default), $items);

        return $this;
    }

    /**
     * Call success or failed format.
     *
     * @param $formatting
     * @param $items
     * @return array
     */
    public function setStatusFormat($formatting, $items = [])
    {
        $endFormat = $this->isSuccess() ? $this->setSuccessFormat($items) : $this->setFailedFormat($items);

        return array_merge($formatting, $endFormat);
    }

    /**
     * Set base format, link, method.
     *
     * @param Request $request
     * @return array
     */
    public function setBaseFormat(Request $request)
    {
        return [
            'link' => $request->fullUrl(),
            'method' => $request->getMethod(),
        ];
    }

    /**
     * Set required format, status code and message.
     *
     * @param $code
     * @return array
     */
    public function setDefaultFormat($code)
    {
        return [
            'code' => $code,
            'message' => $this->getMessage(),
        ];
    }

    /**
     * Final result endpoint.
     *
     * @return static
     */
    public function getResult()
    {
        return $this->result;
    }


    /**
     * The formatter called success or failed.
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->status;
    }
}