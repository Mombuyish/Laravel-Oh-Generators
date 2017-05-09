<?php

namespace Yish\Generators\Foundation\Format;

use Illuminate\Http\Request;
use Yish\Generators\Exceptions\MethodNotFoundException;
use Yish\Generators\Foundation\Format\Concerns\HasMessage;

trait SuccessAndFailed
{
    /*
     * Message getter/setter.
     */
    use HasMessage;

    /**
     * @var static
     * Return property.
     */
    protected $result;

    /**
     * @param Request $request
     * @param array $items
     * @param int $status
     * @param string $message
     * @return static
     * Operation interface.
     */
    public function format(Request $request, $items = [], $message = '', $status = 200)
    {
        return $this->formatting($request, $items, $message, $status)->getResult();
    }

    /**
     * @param Request $request
     * @param array $items
     * @param string $message
     * @param int $status
     * @return $this Progressing formatting.
     * Progressing formatting.
     * @internal param int $code
     */
    public function formatting(Request $request, $items = [], $message = '', $status = 200)
    {
        return static::formatted($request, $items, $message, $status);
    }

    /**
     * @param Request $request
     * @param array $items
     * @param string $message
     * @param int $status
     * @return $this Progressing final endpoint.
     * Progressing final endpoint.
     * @internal param int $statusCode
     */
    public function formatted(Request $request, $items = [], $message = '', $status = 200)
    {
        $base = $this->setBaseFormat($request);

        $message = $this->isMessage($message);

        $success = array_merge($base, $this->setSuccessFormat($items, $status, $message));
        $failed = array_merge($base, $this->setFailedFormat($status, $message));

        $this->result = $this->isSuccess() ? $success : $failed;

        return $this;
    }

    public function isMessage($message)
    {
        if (! method_exists(static::class, 'message')) {
            return $message;
        }

        $call = static::message();

        return $call ?: $message;
    }

    /**
     * @param Request $request
     * @return array
     * Set base format, request url and call HTTP verb.
     */
    private function setBaseFormat(Request $request)
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
     * Set required format, status code and message
     */
    private function setDefaultFormat($code, $message)
    {
        return [
            'code' => $code,
            'message' => $message ?: $this->getMessage(),
        ];
    }

    /**
     * @param $items
     * @param $code
     * @param $message
     * @return array
     * Merge success required format to base format.
     */
    private function setSuccessFormat($items, $code, $message)
    {
        $message ?: $this->getMessage();

        return array_merge($this->setDefaultFormat($code, $message), [
            'items' => $items,
        ]);
    }

    /**
     * @param $code
     * @param $message
     * @return array
     * Merge failed required format to base format.
     */
    private function setFailedFormat($code, $message)
    {
        $message ?: $this->setErrorMessage();

        return [
            'error' => $this->setDefaultFormat($code, $message),
        ];
    }

    /**
     * @return bool
     * @throws MethodNotFoundException
     * Be sure the success method is exist.
     */
    protected function isSuccess()
    {
        if (! method_exists(static::class, 'success')) {
            throw new MethodNotFoundException('success');
        }

        return (bool) static::success();
    }

    /**
     * @return static
     * Final result endpoint.
     */
    public function getResult()
    {
        return $this->result;
    }
}