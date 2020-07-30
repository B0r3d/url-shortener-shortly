<?php


namespace App\Tests\Http\Action;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    /** @test */
    public function it_returns_status_200()
    {
        $client = $this->createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}