<?php


namespace App\Tests\Application\Link;


use App\Model\Link\Entity\Link;
use App\Model\Link\LinkFactoryInterface;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class LinkFactoryTest extends WebTestCase
{
    private LinkFactoryInterface $linkFactory;

    public function setUp(): void
    {
        $container = $this->bootKernel()->getContainer();
        $this->linkFactory = $container->get('Test.LinkFactory');
    }

    /** @test */
    public function it_creates_link()
    {
        $url = 'https://google.com';
        $link = $this->linkFactory->createLink($url);

        $this->assertInstanceOf(Link::class, $link);
        $this->assertEquals($url, $link->getUrl()->toString());
        $this->assertEquals(0, $link->getVisits()->count());
    }
}