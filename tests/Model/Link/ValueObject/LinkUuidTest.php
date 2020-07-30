<?php


namespace App\Tests\Model\Link\ValueObject;


use App\Model\Link\ValueObject\LinkUuid;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class LinkUuidTest extends TestCase
{
    /** @test */
    public function valid_uuid_can_be_created()
    {
        $uuid = LinkUuid::fromString(Uuid::uuid4());

        $this->assertInstanceOf(LinkUuid::class, $uuid);
        $this->assertIsString($uuid->toString());
    }

    /** @test */
    public function it_throws_exception_if_uuid_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $uuid = LinkUuid::fromString('');
    }
}