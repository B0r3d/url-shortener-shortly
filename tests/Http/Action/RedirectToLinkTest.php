<?php


namespace App\Tests\Http\Action;


use App\Model\Link\Entity\Link;
use App\Model\Link\LinkRepositoryInterface;
use App\Tests\Infrastructure\Link\Fixture\LinkFixture;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class RedirectToLinkTest extends WebTestCase
{
    use FixturesTrait;

    private LinkRepositoryInterface $linkRepository;

    public function setUp(): void
    {
        $container = $this->bootKernel()->getContainer();
        $this->linkRepository = $container->get('Test.LinkRepository');
    }

    /** @test */
    public function it_redirects_to_link()
    {
        $this->loadFixtures([LinkFixture::class]);

        /** @var Link $link */
        $link = $this->linkRepository->findByUrl('https://google.com');
        $client = $this->createClient();

        $this->assertEquals(0, $link->getVisits()->count());
        $client->request('GET', '/go/' . $link->getHash()->toString());
        $response = $client->getResponse();

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('https://google.com', $response->headers->get('location'));

        $link = $this->linkRepository->findByUrl('https://google.com');
        $this->assertEquals(1, $link->getVisits()->count());
    }

    /** @test */
    public function it_returns_status_code_404_when_link_does_not_exist()
    {
        $client = $this->createClient();

        $client->request('GET', '/go/not-valid');
        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }
}