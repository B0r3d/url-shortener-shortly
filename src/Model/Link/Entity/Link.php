<?php


namespace App\Model\Link\Entity;


use App\Model\Link\ValueObject\Counter;
use App\Model\Link\ValueObject\Hash;
use App\Model\Link\ValueObject\LinkUuid;
use App\Model\Link\ValueObject\Url;

class Link
{
    private ?int $id;
    private LinkUuid $uuid;
    private Counter $visits;
    private Hash $hash;
    private Url $url;
    private \DateTime $createdAt;

    function __construct(LinkUuid $uuid, Url $url, Hash $hash)
    {
        $this->id = null;
        $this->uuid = $uuid;
        $this->url = $url;
        $this->hash = $hash;
        $this->visits = new Counter();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): LinkUuid
    {
        return $this->uuid;
    }

    public function getUrl(): Url
    {
        return $this->url;
    }

    public function getVisits(): Counter
    {
        return $this->visits;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getHash(): Hash
    {
        return $this->hash;
    }
}