<?php


namespace App\Infrastructure\Link\Repository;


use App\Model\Link\Entity\Link;
use App\Model\Link\LinkRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class LinkRepository extends EntityRepository implements LinkRepositoryInterface
{

    public function save(Link $link)
    {
        $this->_em->persist($link);
        $this->_em->flush();
    }


    public function findByHash(string $hash): ?Link
    {
        return $this->findOneBy(['hash.hash' => $hash]);
    }

    public function findByUrl(string $url): ?Link
    {
        return $this->findOneBy(['url.url' => $url]);
    }
}