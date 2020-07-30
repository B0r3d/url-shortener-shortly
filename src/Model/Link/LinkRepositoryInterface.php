<?php


namespace App\Model\Link;


use App\Model\Link\Entity\Link;
use App\Model\Link\ValueObject\LinkUuid;
use App\Model\Link\ValueObject\Url;

interface LinkRepositoryInterface
{
    public function save(Link $link);

    public function findByHash(string $hash): ?Link;

    public function findByUrl(string $url): ?Link;
}