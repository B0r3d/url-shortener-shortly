<?php


namespace App\Tests\Http\Response;


use App\Http\Response\SuccessJsonResponse;
use PHPUnit\Framework\TestCase;

class SuccessJsonResponseTest extends TestCase
{
    /** @test */
    public function success_json_response_can_be_created()
    {
        $content = [
            'ok' => true,
            'payload' => [
                'label' => 'value',
            ],
        ];

        $response = SuccessJsonResponse::fromArray([
            'label' => 'value',
        ], 200);

        $this->assertEquals(json_encode($content), $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}