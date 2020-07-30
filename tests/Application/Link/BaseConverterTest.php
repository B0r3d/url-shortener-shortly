<?php


namespace App\Tests\Application\Link;


use App\Model\Link\BaseConverterInterface;
use App\Model\Link\ValueObject\LinkUuid;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Ramsey\Uuid\Uuid;

class BaseConverterTest extends WebTestCase
{
    private BaseConverterInterface $baseConverter;

    public function setUp(): void
    {
        $container = $this->bootKernel()->getContainer();
        $this->baseConverter = $container->get('Test.BaseConverter');
    }

    /** @test */
    public function it_converts_number_to_base()
    {
        $uuid = 'ee7cf5ee-344c-44f1-a2d4-90f6b026d811';
        $base = $this->baseConverter->convertUuidToBase($uuid);
        $this->assertIsString($base);
        $this->assertEquals('aZl8N0y58I7', $base);
    }
}