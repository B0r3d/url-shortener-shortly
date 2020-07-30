<?php


namespace App\Tests\Model\Link\Entity;


use App\Model\Link\Entity\Link;
use App\Model\Link\ValueObject\Hash;
use App\Model\Link\ValueObject\LinkUuid;
use App\Model\Link\ValueObject\Url;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class LinkTest extends TestCase
{
    /** @test */
    public function link_can_be_created()
    {
        $linkUuid = LinkUuid::fromString(Uuid::uuid4());
        $url = Url::fromString('https://google.com');
        $hash = Hash::fromString('aZl8N0y58I7');
        $link = new Link($linkUuid, $url, $hash);

        $this->assertTrue($link->getUrl()->equals($url));
        $this->assertEquals(0, $link->getVisits()->count());
        $this->assertTrue($link->getUuid()->equals($linkUuid));
    }
}