<?php


namespace App\Tests\Http\Response;


use App\Http\Response\ErrorJsonResponse;
use PHPUnit\Framework\TestCase;

class ErrorJsonResponseTest extends TestCase
{
    /** @test */
    public function error_json_response_can_be_created()
    {
        $content = [
            'ok' => false,
            'error_message' => 'Internal server error',
            'error_code' => 500,
        ];
        $throwable = new \Exception();
        $response = ErrorJsonResponse::fromThrowable($throwable);

        $this->assertEquals(json_encode($content), $response->getContent());
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}