<?php


namespace App\Http\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

class SuccessJsonResponse extends JsonResponse
{
    public static function fromArray(array $payload, int $statusCode = 200, array $headers = []): self
    {
        return new self([
            'ok' => true,
            'payload' => $payload
        ], $statusCode, $headers);
    }

    private function __construct($data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);
    }
}