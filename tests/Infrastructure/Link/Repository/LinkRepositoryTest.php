<?php


namespace App\Tests\Infrastructure\Link\Repository;


use App\Model\Link\Entity\Link;
use App\Model\Link\LinkRepositoryInterface;
use App\Model\Link\ValueObject\Hash;
use App\Model\Link\ValueObject\LinkUuid;
use App\Model\Link\ValueObject\Url;
use App\Tests\Infrastructure\Link\Fixture\LinkFixture;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Ramsey\Uuid\Uuid;

class LinkRepositoryTest extends WebTestCase
{
    use FixturesTrait;

    private LinkRepositoryInterface $linkRepository;

    public function setUp(): void
    {
        $container = $this->bootKernel()->getContainer();

        $this->linkRepository = $container->get('Test.LinkRepository');
    }

    /** @test */
    public function it_saves_link_to_database()
    {
        $this->loadFixtures();
        $linkUuid = LinkUuid::fromString(Uuid::uuid4());
        $url = Url::fromString('https://google.com');
        $hash = Hash::fromString('aZl8N0y58I7');

        $link = new Link($linkUuid, $url, $hash);
        $this->assertCount(0, $this->linkRepository->findAll());
        $this->linkRepository->save($link);
        $this->assertCount(1, $this->linkRepository->findAll());
        $this->assertEquals(1, $link->getId());
    }

    /** @test */
    public function it_returns_link_from_database_by_hash()
    {
        $this->loadFixtures([LinkFixture::class]);
        $link = $this->linkRepository->findByHash('aZl8N0y58I7');

        $this->assertInstanceOf(Link::class, $link);
        $this->assertEquals('aZl8N0y58I7', $link->getHash()->toString());
    }

    /** @test */
    public function it_returns_link_from_database_by_url()
    {
        $this->loadFixtures([LinkFixture::class]);
        $link = $this->linkRepository->findByUrl('https://google.com');
        $this->assertInstanceOf(Link::class, $link);
        $this->assertEquals('https://google.com', $link->getUrl()->toString());
    }
}