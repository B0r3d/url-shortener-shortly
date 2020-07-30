<?php


namespace App\Http\Response;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ErrorJsonResponse extends JsonResponse
{
    public static function fromThrowable(\Throwable $throwable, array $headers = [])
    {
        switch(get_class($throwable)) {
            case BadRequestHttpException::class:
            case \InvalidArgumentException::class:
                $statusCode = 400;
                break;
            default:
                return new self([
                    'ok' => false,
                    'error_message' => 'Internal server error',
                    'error_code' => 500,
                ], 500, $headers);
        }

        return new self([
            'ok' => false,
            'error_message' => $throwable->getMessage(),
            'error_code' => $throwable->getCode(),
        ], $statusCode, $headers);
    }

    private function __construct($data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);
    }
}