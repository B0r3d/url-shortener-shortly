<?php


namespace App\Tests\Model\Link\ValueObject;


use App\Model\Link\ValueObject\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /** @test */
    public function valid_url_can_be_created()
    {
        $urlString = 'https://google.com';
        $url = Url::fromString($urlString);

        $this->assertInstanceOf(Url::class, $url);
        $this->assertIsString($url->toString());
        $this->assertEquals($urlString, $url->toString());
    }

    /** @test */
    public function it_throws_exception_if_url_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $url = Url::fromString('invalid-url');
    }
}