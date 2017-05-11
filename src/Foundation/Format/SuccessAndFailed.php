<?php

namespace Yish\Generators\Foundation\Format;

use Illuminate\Http\Request;
use Yish\Generators\Foundation\Format\Concerns\FormatFailed;
use Yish\Generators\Foundation\Format\Concerns\HasMessage;
use Yish\Generators\Foundation\Format\Concerns\FormatSuccess;

trait SuccessAndFailed
{
    use HasMessage,
        FormatSuccess,
        FormatFailed;

    /**
     * @var static
     *
     * Return property.
     */
    protected $result;

    /**
     * @param Request $request
     * @param array $items
     * @param string $message
     * @param int $code
     * @return static Operation interface.
     *
     * Operation interface.
     */
    public function format(Request $request, $items = [], $message = '', $code = 200)
    {
        $this->replaceMessage();

        return $this->formatting($request, $items, $code)->getResult();
    }

    /**
     * @param Request $request
     * @param array $items
     * @param $code
     * @return $this Progressing formatting.
     *
     * Progressing formatting.
     */
    public function formatting(Request $request, $items, $code)
    {
        return static::formatted($request, $items, $code);
    }

    /**
     * @param Request $request
     * @param array $items
     * @param $code
     * @return $this Progressing final endpoint.
     *
     * Progressing final endpoint.
     */
    public function formatted(Request $request, $items, $code)
    {
        $base = $this->setBaseFormat($request);

        $default = $this->setDefaultFormat($code, $this->getMessage());

        $this->result = $this->setStatusFormat(array_merge($base, $default), $items);

        return $this;
    }

    /**
     * @param $formatting
     * @param $items
     * @return array
     *
     * Call success or failed format.
     */
    public function setStatusFormat($formatting, $items)
    {
        $endFormat = $this->isSuccess() ? $this->setSuccessFormat($items) : $this->setFailedFormat($items);

        return array_merge($formatting, $endFormat);
    }

    /**
     * @param Request $request
     * @return array
     *
     * Set base format, link, method.
     */
    public function setBaseFormat(Request $request)
    {
        return [
            'link' => $request->fullUrl(),
            'method' => $request->getMethod(),
        ];
    }

    /**
     * @param $code
     * @param $message
     * @return array
     *
     * Set required format, status code and message
     */
    public function setDefaultFormat($code, $message)
    {
        return [
            'code' => $code,
            'message' => $this->getMessage(),
        ];
    }

    /**
     * @return static
     * Final result endpoint.
     */
    public function getResult()
    {
        return $this->result;
    }


    /**
     * @return bool
     *
     * The formatter called success or failed.
     */
    public function isSuccess()
    {
        return $this->status;
    }
}