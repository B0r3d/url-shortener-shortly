<?php


namespace App\Tests\Infrastructure\Link\Fixture;


use App\Model\Link\Entity\Link;
use App\Model\Link\ValueObject\Hash;
use App\Model\Link\ValueObject\LinkUuid;
use App\Model\Link\ValueObject\Url;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class LinkFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $linkUuid = LinkUuid::fromString(Uuid::uuid4());
        $url = Url::fromString('https://google.com');
        $hash = Hash::fromString('aZl8N0y58I7');
        $link = new Link($linkUuid, $url, $hash);

        $manager->persist($link);
        $manager->flush();
    }
}