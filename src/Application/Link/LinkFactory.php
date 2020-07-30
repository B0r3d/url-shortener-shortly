<?php


namespace App\Application\Link;


use App\Model\Link\BaseConverterInterface;
use App\Model\Link\Entity\Link;
use App\Model\Link\LinkFactoryInterface;
use App\Model\Link\ValueObject\Hash;
use App\Model\Link\ValueObject\LinkUuid;
use App\Model\Link\ValueObject\Url;
use Ramsey\Uuid\Uuid;

class LinkFactory implements LinkFactoryInterface
{
    private BaseConverterInterface $baseConverter;

    public function __construct(BaseConverterInterface $baseConverter)
    {
        $this->baseConverter = $baseConverter;
    }

    public function createLink(string $url): Link
    {
        $uuid = LinkUuid::fromString(Uuid::uuid4());
        $url = Url::fromString($url);
        $hash = Hash::fromString($this->baseConverter->convertUuidToBase($uuid->toString()));
        return new Link($uuid, $url, $hash);
    }
}