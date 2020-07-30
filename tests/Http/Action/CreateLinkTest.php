<?php


namespace App\Tests\Http\Action;


use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class CreateLinkTest extends WebTestCase
{
    use FixturesTrait;

    /** @test */
    public function it_creates_link_on_valid_request()
    {
        $this->loadFixtures();
        $client = $this->createClient();
        $request = file_get_contents(__DIR__ . '/CreateLinkTest/valid_request.json');
        $client->request('POST', '/api/link', [], [], [], $request);

        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertTrue($response['ok']);
        $this->assertArrayHasKey('payload', $response);
        $this->assertArrayHasKey('link', $response['payload']);
        $this->assertArrayHasKey('hash', $response['payload']['link']);
        $this->assertArrayHasKey('url_long', $response['payload']['link']);
        $this->assertArrayHasKey('url_short', $response['payload']['link']);
    }
}